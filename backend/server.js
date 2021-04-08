const db = require("./db.js");
const bodyParser = require("body-parser");
const express = require("express");
const app = express();
const port = 3000;
const bcrypt = require("bcrypt");
const saltRounds = 10;

app.use(bodyParser.json());

app.get("/", (req, res) => {
  res.send("Hello Toni!");
});

app.listen(port, () => {
  console.log(`Example app listening at http://localhost:${port}`);
});

app.get("/products", (req, res) => {
  db.query(
    "SELECT * FROM product WHERE available = 1",
    function (error, results, fields) {
      if (error) {
        console.log(error);
      }
      // error will be an Error if one occurred during the query
      // results will contain the results of the query
      // fields will contain information about the returned results fields (if any)
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

app.get("/users", (req, res) => {
  db.query(
    "SELECT id, email, userType FROM user",
    function (error, results, fields) {
      if (error) {
        console.log(error);
      }
      // error will be an Error if one occurred during the query
      // results will contain the results of the query
      // fields will contain information about the returned results fields (if any)
      res.json(results);
    }
  );
});

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
      console.log(numRows);
      if (numRows == 1) {
        res.status(409).json({
          message: "This email is already registered.",
        });
      } else {
        console.log("insert");
        db.query(
          "INSERT INTO user(email, password) VALUES (?, ?)",
          values,
          function (error, results, fields) {
            if (error) {
              console.log(error);
            }
            res.status(201).json({
              message: "You successfully registered!",
              id: results.insertId,
              email: req.body.email,
            });
          }
        );
      }
    }
  );
});

app.get("/purchases", (req, res) => {
  db.query("SELECT * FROM purchase", function (error, results, fields) {
    if (error) {
      console.log(error);
    }
    // error will be an Error if one occurred during the query
    // results will contain the results of the query
    // fields will contain information about the returned results fields (if any)
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
