const db = require("./db.js");
require("dotenv").config();
const bodyParser = require("body-parser");
const express = require("express");
const app = express();
const port = 3000;
const bcrypt = require("bcrypt");
const saltRounds = 10;
const jwt = require("jsonwebtoken");
const { request } = require("express");

const generateAccessToken = (data) => {
  //expires after an hour
  console.log(data);
  return jwt.sign(data, process.env.JWT_SECRET, { expiresIn: "3600s" });
};

const authenticateToken = (req, res, next) => {
  const authHeader = req.headers["authorization"];
  //if not empty split
  const token = authHeader && authHeader.split(" ")[1];
  if (token == null) {
    res.status(401).json({
      error: "You need to be authenticated",
    });
  }

  jwt.verify(token, process.env.JWT_SECRET, async (err, user) => {
    if (err) {
      res.status(401).json({
        error: "You need to be authenticated",
      });
    }
    console.log(user);
    req.userId = user.id;
    req.token = token;
    next();
  });
};

app.use(express.json());
app.use(
  express.urlencoded({
    extended: true,
  })
);

app.get("/", (req, res) => {
  res.send("Hello Toni!");
});

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`);
});

//registering only if email is unique
app.post("/signup", async (req, res) => {
  const myPlaintextPassword = req.body.password;
  console.log(myPlaintextPassword);
  const hash = bcrypt.hashSync(myPlaintextPassword, saltRounds);
  const values = [req.body.email, hash];
  let numRows;
  await db.query(
    "SELECT email FROM user WHERE email = ?",
    values[0],
    function (error, results, fields) {
      if (error) {
        console.log(error);
      }
      numRows = results.length;
      if (numRows == 1) {
        res.status(409).json({
          error: "This email is already registered.",
        });
      } else {
        db.query(
          "INSERT INTO user(email, password) VALUES (?, ?)",
          values,
          function (error, results, fields) {
            if (error) {
              console.log(error);
            }
            const tokenData = {
              email: req.body.email,
              //hmm, sus
              id: results.insertId,
              userType: "Customer",
            };
            const genToken = generateAccessToken(tokenData);
            req.userId = results.insertId;
            res.status(201).json({
              message: "You successfully registered!",
              id: results.insertId,
              email: req.body.email,
              userType: "Customer",
              token: genToken,
            });
          }
        );
      }
    }
  );
});

app.post("/login", async (req, res, next) => {
  const passwordSql = "SELECT password FROM user WHERE email = ?";
  const passwordSqlValue = req.body.email;
  const data = await db.query(
    passwordSql,
    passwordSqlValue,
    function (error, results, fields) {
      if (!results.length) {
        res.status(400).json({
          error: "Invalid email or the email is not registered!",
        });
      }
      const storedHashValue = results[0].password;
      if (bcrypt.compareSync(req.body.password, storedHashValue)) {
        const values = [storedHashValue, req.body.email];
        db.query(
          "SELECT id, email, userType FROM user WHERE password = ? AND email = ?",
          values,
          function (error, results, fields) {
            if (error) {
              console.log(error);
            }
            const tokenData = {
              email: results[0].email,
              id: results[0].id,
              userType: results[0].userType,
            };
            const genToken = generateAccessToken(tokenData);
            req.userId = results.id;
            res.status(200).json({
              message: "You are now logged in!",
              user: results,
              token: genToken,
            });
          }
        );
      } else {
        res.status(401).json({
          error: "Invalid password!",
        });
      }
    }
  );
});

app.patch("/users/:id", authenticateToken, (req, res) => {
  const values = [req.body.password, req.userId];
  if (req.body.password == null || " ") {
    res.status(400).json({
      error: "You need to enter a new password!",
    });
  } else {
    db.query(
      "UPDATE user SET password = ? WHERE id = ?",
      values,
      function (error, results, fields) {
        if (error) {
          console.log(error);
        }
        res.status(200).json({
          message: "You successfully updated your password.",
        });
      }
    );
  }
});

/*app.delete("users/:id", authenticateToken, (req, res) => {
  db.query(
    "DELETE FROM user WHERE id = ?"
    
  )
});*/

/*users endpoint, getting all users NOT FINISHED
app.get("/users", (req, res) => {
  db.query(
    "SELECT id, email, userType FROM user",

    function (error, results, fields) {
      if (error) {
        console.log(error);
      }
      res.json(results);
    }
  );
});*/

app.get("/products", (req, res) => {
  db.query(
    "SELECT * FROM product WHERE available = 1",
    function (error, results, fields) {
      if (error) {
        console.log(error);
      }
      res.json(results);
    }
  );
});

app.post("/products", (req, res) => {
  const values = [
    req.body.name,
    req.body.price,
    req.body.sizeId,
    req.body.fit,
    req.body.condition,
    req.body.image,
    req.body.genderId,
    req.body.typeId,
    req.body.brandId,
  ];
  db.query(
    "INSERT INTO product(name, price, sizeId, fit, condition, image, genderId, typeId, brandId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
    [values],
    function (error, results, fields) {
      if (error) {
        console.log(error);
      }
      res.json({
        status: 200,
        message: "A new product was successfully added!",
      });
    }
  );
});

app.get("/products/:id", (req, res) => {
  const productId = req.params.id;
  db.query(
    "SELECT * FROM product WHERE available = 1 AND id = ?",
    productId,
    function (error, results, fields) {
      if (error) {
        console.log(error);
      }
      res.json(results);
    }
  );
});

app.patch("/products/:id", (req, res) => {
  const productId = req.params.id;
  db.query(
    "UPDATE product SET available = 0 WHERE id = ?",
    productId,
    function (error, results, fields) {
      if (error) {
        console.log(error);
      }
      res.status(200).end();
    }
  );
});

app.get("/purchases", authenticateToken, (req, res) => {
  const purchaseSql = `SELECT purchaseUser.purchaseId, purchaseUser.userId, purchase.total, purchase.purchaseDate, purchaseProduct.productId, product.name, product.price, size.name, product.fit, product.condition, product.image, brand.name 
    FROM purchaseUser 
    INNER JOIN purchase ON purchaseUser.purchaseId = purchase.id 
    INNER JOIN purchaseProduct ON purchase.id = purchaseProduct.purchaseId 
    INNER JOIN product ON purchaseProduct.productId = product.id 
    INNER JOIN size ON product.sizeId = size.id 
    INNER JOIN brand ON product.brandId = brand.id 
    WHERE purchaseUser.userId = ?`;
  const values = req.userId;
  console.log(values);
  db.query(purchaseSql, values, function (error, results, fields) {
    if (error) {
      console.log(error);
    }
    res.json(results);
  });
});

app.get("/brands", (req, res) => {
  db.query("SELECT * FROM brand", function (error, results, fields) {
    if (error) {
      console.log(error);
    }
    // error will be an Error if one occurred during the query
    // results will contain the results of the query
    // fields will contain information about the returned results fields (if any)
    res.json(results);
  });
});

app.get("/genders", (req, res) => {
  db.query("SELECT * FROM gender", function (error, results, fields) {
    if (error) {
      console.log(error);
    }
    // error will be an Error if one occurred during the query
    // results will contain the results of the query
    // fields will contain information about the returned results fields (if any)
    res.json(results);
  });
});

app.get("/sizes", (req, res) => {
  db.query("SELECT * FROM size", function (error, results, fields) {
    if (error) {
      console.log(error);
    }
    // error will be an Error if one occurred during the query
    // results will contain the results of the query
    // fields will contain information about the returned results fields (if any)
    res.json(results);
  });
});

app.get("/types", (req, res) => {
  db.query("SELECT * FROM type", function (error, results, fields) {
    if (error) {
      console.log(error);
    }
    // error will be an Error if one occurred during the query
    // results will contain the results of the query
    // fields will contain information about the returned results fields (if any)
    res.json(results);
  });
});
