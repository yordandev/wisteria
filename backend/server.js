const db = require('./db.js')
require('dotenv').config()
const bodyParser = require('body-parser')
const express = require('express')
const app = express()
const bcrypt = require('bcrypt')
const jwt = require('jsonwebtoken')
const morgan = require('morgan')
const port = 3000
const saltRounds = 10

const validateEmail = (email) => {
	const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
	return re.test(String(email).toLowerCase())
}

const generateAccessToken = (data) => jwt.sign(data, process.env.JWT_SECRET, { expiresIn: '3600s' })

const authenticateToken = (req, res, next) => {
	const authHeader = req.headers['authorization']
	//if not empty split
	const token = authHeader && authHeader.split(' ')[1]
	if (token == null) {
		res.status(401).json({
			error: 'You need to be authenticated',
		})
	}

	jwt.verify(token, process.env.JWT_SECRET, async (err, user) => {
		if (err) {
			res.status(401).json({
				error: 'You need to be authenticated',
			})
		}

		const userCheckSql = 'SELECT type FROM user WHERE id = ?'
		await db.query(userCheckSql, user.id, function (error, results, fields) {
			if (error) {
				console.log(error)
			}
			if (results.length == 1) {
				req.userId = user.id
				req.userType = results[0].type
				req.token = token
				next()
			} else {
				res.status(401).json({
					error: 'You need to be authenticated',
				})
			}
		})
	})
}

app.use(express.json())
app.use(
	express.urlencoded({
		extended: true,
	})
)
app.use(morgan('tiny'))

app.get('/', (req, res) => {
	res.send('hi from Wisteria')
})

app.listen(port, () => {
	console.log(`Wisteria server listening at http://${process.env.DB_HOST}:${port}`)
})

//registering only if email is unique
app.post('/signup', async (req, res) => {
	const plainTextPassword = req.body.password
	const email = req.body.email

	if (
		!plainTextPassword ||
		typeof plainTextPassword != 'string' ||
		!email ||
		typeof email != 'string'
	) {
		res.status(400).json({
			error: 'Bad request',
		})
	}

	const validEmail = validateEmail(email)

	if (!validEmail) {
		res.status(400).json({
			error: 'Invalid email format',
		})
	} else {
		const hash = bcrypt.hashSync(plainTextPassword, saltRounds)
		const values = [email, hash]
		let numRows
		await db.query(
			'SELECT email FROM user WHERE email = ?',
			values[0],
			function (error, results, fields) {
				if (error) {
					console.log(error)
				}
				numRows = results.length
				if (numRows == 1) {
					res.status(409).json({
						error: 'This email is already registered.',
					})
				} else {
					db.query(
						'INSERT INTO user(email, password) VALUES (?, ?)',
						values,
						function (error, results, fields) {
							if (error) {
								console.log(error)
							}
							const tokenData = {
								email: req.body.email,
								id: results.insertId,
								type: 'Customer',
							}
							const genToken = generateAccessToken(tokenData)
							req.userId = results.insertId
							res.status(201).json({
								message: 'You successfully registered',
								id: results.insertId,
								email: req.body.email,
								type: 'Customer',
								token: genToken,
							})
						}
					)
				}
			}
		)
	}
})

app.post('/login', async (req, res, next) => {
	const plainTextPassword = req.body.password
	const email = req.body.email

	if (
		!plainTextPassword ||
		typeof plainTextPassword != 'string' ||
		!email ||
		typeof email != 'string'
	) {
		res.status(400).json({
			error: 'Bad request',
		})
	}

	const validEmail = validateEmail(email)

	if (!validEmail) {
		res.status(400).json({
			error: 'Invalid email format',
		})
	} else {
		const passwordSql = 'SELECT password FROM user WHERE email = ?'
		const passwordSqlValue = email
		const data = await db.query(passwordSql, passwordSqlValue, function (error, results, fields) {
			if (!results.length) {
				res.status(400).json({
					error: 'Invalid email or the email is not registered',
				})
			}
			const storedHashValue = results[0].password
			if (bcrypt.compareSync(plainTextPassword, storedHashValue)) {
				const values = [storedHashValue, email]
				db.query(
					'SELECT id, email, type FROM user WHERE password = ? AND email = ?',
					values,
					function (error, results, fields) {
						if (error) {
							console.log(error)
						}
						const tokenData = {
							email: results[0].email,
							id: results[0].id,
							type: results[0].type,
						}
						const genToken = generateAccessToken(tokenData)
						req.userId = results.id
						res.status(200).json({
							message: 'You are now logged in',
							user: results,
							token: genToken,
						})
					}
				)
			} else {
				res.status(401).json({
					error: 'Invalid password',
				})
			}
		})
	}
})

app.patch('/users/:id', authenticateToken, (req, res) => {
	const values = [req.body.password, req.userId]

	if (!values[0]) {
		res.status(400).json({
			error: 'You need to enter a new password',
		})
	} else {
		db.query(
			'UPDATE user SET password = ? WHERE id = ?',
			values,
			function (error, results, fields) {
				if (error) {
					console.log(error)
				}
				res.status(200).json({
					message: 'You successfully updated your password.',
				})
			}
		)
	}
})

app.delete('/users/:id', authenticateToken, (req, res) => {
	const value = req.params.id
	if (value == req.userId) {
		db.query('DELETE FROM purchase WHERE id = ?', value, function (error, results, fields) {
			if (error) {
				console.log(error)
			}
			res.status(200).json({
				message: 'Your account was deleted.',
			})
		})

		db.query('DELETE FROM user WHERE id = ?', value, function (error, results, fields) {
			if (error) {
				console.log(error)
			}
			res.status(200).json({
				message: 'Your account was deleted.',
			})
		})
	} else {
		res.status(401).json({
			message: 'You are unauthorized.',
		})
	}
})

app.get('/users/:id', authenticateToken, (req, res) => {
	const value = req.params.id
	if (value == req.userId) {
		db.query(
			'SELECT id, email, type FROM user WHERE id = ?',
			value,
			function (error, results, fields) {
				if (error) {
					console.log(error)
				}
				res.json(results)
			}
		)
	} else {
		res.status(401).json({
			message: 'You are unauthorized.',
		})
	}
})

app.get('/products', (req, res) => {
	let sql = `SELECT product.id, product.name, product.price, product.fit, product.condition, product.image, product.dateAdded, product.available, size.name AS size, gender.name AS gender, brand.name AS brand, type.name AS type FROM product 
  INNER JOIN size ON product.sizeId = size.id
  INNER JOIN gender ON product.genderId = gender.id 
  INNER JOIN brand ON product.brandId = brand.id 
  INNER JOIN type ON product.typeId = type.id 
  WHERE available = 1 ORDER BY dateAdded DESC`
	let limit = req.query.limit

	if (limit) {
		sql = `SELECT product.id, product.name, product.price, product.fit, product.condition, product.image, product.dateAdded, product.available, size.name AS size, gender.name AS gender, brand.name AS brand, type.name AS type FROM product 
    INNER JOIN size ON product.sizeId = size.id
    INNER JOIN gender ON product.genderId = gender.id 
    INNER JOIN brand ON product.brandId = brand.id 
    INNER JOIN type ON product.typeId = type.id 
    WHERE available = 1 ORDER BY dateAdded DESC LIMIT ?`
	}

	db.query(sql, Number(limit), function (error, results, fields) {
		if (error) {
			console.log(error)
		}
		res.json(results)
	})
})

app.post('/products', authenticateToken, (req, res) => {
	if (req.userType != 'Admin') {
		res.status(401).json({
			error: 'Unauthorized',
		})
	} else {
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
		]

		if (
			!req.body.name ||
			typeof req.body.name != 'string' ||
			!req.body.price ||
			typeof req.body.price != 'string' ||
			typeof req.body.price != 'number' ||
			!req.body.sizeId ||
			typeof req.body.sizeId != 'string' ||
			typeof req.body.sizeId != 'number' ||
			!req.body.fit ||
			typeof req.body.fit != 'string' ||
			!req.body.condition ||
			typeof req.body.condition != 'string' ||
			!req.body.image ||
			typeof req.body.image != 'string' ||
			!req.body.genderId ||
			typeof req.body.genderId != 'string' ||
			typeof req.body.genderId != 'number' ||
			!req.body.typeId ||
			typeof req.body.typeId != 'string' ||
			typeof req.body.typeId != 'number' ||
			!req.body.brandId ||
			typeof req.body.brandId != 'string' ||
			typeof req.body.brandId != 'number'
		) {
			res.status(400).json({
				error: 'Bad request',
			})
		} else {
			db.query(
				'INSERT INTO product(name, price, sizeId, fit, condition, image, genderId, typeId, brandId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
				[values],
				function (error, results, fields) {
					if (error) {
						console.log(error)
					}
					res.status(201).json({
						message: 'A new product was successfully added',
					})
				}
			)
		}
	}
})

app.get('/products/:id', (req, res) => {
	const productId = req.params.id

	db.query(
		`SELECT product.id, product.name, product.price, product.fit, product.condition, product.image, product.dateAdded, product.available, size.name AS size, gender.name AS gender, brand.name AS brand, type.name AS type FROM product 
	INNER JOIN size ON product.sizeId = size.id
	INNER JOIN gender ON product.genderId = gender.id 
	INNER JOIN brand ON product.brandId = brand.id 
	INNER JOIN type ON product.typeId = type.id 
	WHERE available = 1 AND product.id = ?`,
		productId,
		function (error, results, fields) {
			if (error) {
				console.log(error)
			}
			res.json(results)
		}
	)
})

app.patch('/products/:id', (req, res) => {
	const productId = req.params.id
	db.query(
		'UPDATE product SET available = 0 WHERE id = ?',
		productId,
		function (error, results, fields) {
			if (error) {
				console.log(error)
			}
			res.status(200).end()
		}
	)
})

app.get('/purchases', authenticateToken, (req, res) => {
	const purchaseSql = `SELECT purchaseUser.purchaseId, purchaseUser.userId, purchase.total, purchase.purchaseDate, purchaseProduct.productId, product.name, product.price, size.name, product.fit, product.condition, product.image, brand.name 
    FROM purchaseUser 
    INNER JOIN purchase ON purchaseUser.purchaseId = purchase.id 
    INNER JOIN purchaseProduct ON purchase.id = purchaseProduct.purchaseId 
    INNER JOIN product ON purchaseProduct.productId = product.id 
    INNER JOIN size ON product.sizeId = size.id 
    INNER JOIN brand ON product.brandId = brand.id 
    WHERE purchaseUser.userId = ?`
	const values = req.userId

	db.query(purchaseSql, values, function (error, results, fields) {
		if (error) {
			console.log(error)
		}
		res.json(results)
	})
})

app.post('/purchases', authenticateToken, async (req, res) => {
	if (!req.body.products || !Array.isArray(req.body.products)) {
		res.status(400).json({
			error: 'Bad request',
		})
	} else {
		await db.query(
			'INSERT INTO purchase(userId, status) VALUES (?, ?)',
			[req.userId, 1],
			async function (error, results, fields) {
				if (error) {
					console.log(error)
				} else {
					const userValues = [results.insertId, req.userId]
					await db.query(
						'INSERT INTO purchaseUser(purchaseId, userId) VALUES (?, ?)',
						userValues,
						function (error, results, fields) {
							if (error) {
								console.log(error)
							}
						}
					)
					for (let i = 0; i < req.body.products.length; i++) {
						const productValues = [results.insertId, req.body.products[i]]
						await db.query(
							'INSERT INTO purchaseProduct(purchaseId, productId) VALUES (?,?)',
							productValues,
							function (error, results, fields) {
								if (error) {
									console.log(error)
								}
							}
						)
					}
					const purchaseValue = [results.insertId, results.insertId]
					await db.query(
						`UPDATE
          purchase
      SET
          purchase.total =(
          SELECT
              SUM(product.price)
          FROM
              purchaseProduct
          INNER JOIN product ON purchaseProduct.productId = product.id
          WHERE
              purchaseProduct.purchaseId = ?
      ) WHERE purchase.id = ?;`,
						purchaseValue,
						function (error, results, fields) {
							if (error) {
								console.log(error)
							} else {
								res.status(201).json({
									message: 'Your purchase was successfully made',
								})
							}
						}
					)
				}
			}
		)
	}
})

app.get('/brands', (req, res) => {
	db.query('SELECT * FROM brand', function (error, results, fields) {
		if (error) {
			console.log(error)
		}
		res.json(results)
	})
})

app.post('/brands', authenticateToken, (req, res) => {
	if (req.userType != 'Admin') {
		res.status(401).json({
			error: 'Unauthorized',
		})
	} else {
		const value = req.body.name

		if (!value) {
			res.status(400).json({
				error: 'Bad request',
			})
		}

		db.query('INSERT INTO brand(name) VALUES (?)', value, function (error, results, fields) {
			if (error) {
				console.log(error)
			} else {
				res.status(201).json({
					message: 'A brand was successfully added',
				})
			}
		})
	}
})

app.get('/genders', (req, res) => {
	db.query('SELECT * FROM gender', function (error, results, fields) {
		if (error) {
			console.log(error)
		}
		res.json(results)
	})
})

app.get('/sizes', (req, res) => {
	db.query('SELECT * FROM size', function (error, results, fields) {
		if (error) {
			console.log(error)
		}
		res.json(results)
	})
})

app.post('/sizes', authenticateToken, (req, res) => {
	if (req.userType != 'Admin') {
		res.status(401).json({
			error: 'Unauthorized',
		})
	} else {
		const value = req.body.name

		if (!value) {
			res.status(400).json({
				error: 'Bad request',
			})
		}

		db.query('INSERT INTO size(name) VALUES (?)', value, function (error, results, fields) {
			if (error) {
				console.log(error)
			} else {
				res.status(201).json({
					message: 'A brand was successfully added',
				})
			}
		})
	}
})

app.get('/types', (req, res) => {
	db.query('SELECT * FROM type', function (error, results, fields) {
		if (error) {
			console.log(error)
		}
		res.json(results)
	})
})
