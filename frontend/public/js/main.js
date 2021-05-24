window.addEventListener('DOMContentLoaded', (event) => {
	const coll = document.getElementsByClassName('collapsible')
	const password = document.getElementById('signUpPassword')
	const confirmPassword = document.getElementById('signUpConfirmPassword')

	for (let i = 0; i < coll.length; i++) {
		coll[i].addEventListener('click', function () {
			this.classList.toggle('active')
			const content = this.nextElementSibling
			if (content.style.maxHeight) {
				content.style.maxHeight = null
			} else {
				content.style.maxHeight = content.scrollHeight + 5 + 'px'
			}
		})
	}

	function validatePassword() {
		if (password.value != confirmPassword.value) {
			confirmPassword.setCustomValidity('The passwords you entered do not match.')
		} else {
			confirmPassword.setCustomValidity('')
		}
	}

	if (password != null && confirmPassword != null) {
		password.onchange = validatePassword
		confirmPassword.onkeyup = validatePassword
	}

	function dropdownToggle(myDropdown, buttonId) {
		document.getElementById(buttonId).classList.toggle('active')
		document.getElementById(myDropdown).classList.toggle('show')
	}

	function genderFilter() {
		const gender = document.getElementById('productGender').value

		if (gender == 1) {
			document.getElementById('productType')[3].disabled = true
		} else {
			document.getElementById('productType')[3].disabled = false
		}
	}
})
