<script>
	let fullDate = document.querySelector(".full_date");
	let date = new Date();
	
	function renderCalendar() {
		date.setDate(1);

		const monthDays = document.querySelector(".days");
		const lastDay = new Date(
			date.getFullYear(),
			date.getMonth() + 1,
			0
		).getDate();

		const prevLastDay = new Date(
			date.getFullYear(),
			date.getMonth(),
			0
		).getDate();

		const firstDayIndex = date.getDay() == 0 ? 6 : date.getDay() - 1;

		const lastDayIndex = new Date(
			date.getFullYear(),
			date.getMonth() + 1,
			0
		).getDay();

		const months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
		document.querySelector(".month_display").innerHTML = months[date.getMonth()];

		let dateFr = new Date().toDateString();
		fullDate.innerHTML = dateInFr(dateFr);

		let days = "";
		totalDays = 0;

		for (let x = firstDayIndex; x > 0; x--) {
			days += `<div class="day prev_date">${prevLastDay - x + 1}</div>`;
			totalDays++
		}

		for (let i = 1; i <= lastDay; i++) {
			if (i === new Date().getDate() && date.getMonth() === new Date().getMonth() && date.getFullYear() === new Date().getFullYear()) {
				days += `<div class="day today">${i}</div>`;
			} else {
				days += `<div class="day">${i}</div>`;
			}
			totalDays++
		}

		const nextDays = 42 - totalDays;
		for (let j = 1; j <= nextDays; j++) {
			days += `<div class="day next_date">${j}</div>`;
		}

		monthDays.innerHTML = days;
		return date;
	};

	getTheSlots(date);
	renderCalendar();
	getAllAppointements("future_date");

	document.querySelector(".prev").addEventListener("click", () => {
		prevMonth();
	});

	document.querySelector(".next").addEventListener("click", () => {
		nextMonth();
	});


	function handleSelection() {

		let timeArray = Array.from(document.querySelectorAll('.slot'));
		let today = document.querySelector('.today');
		let daysArray = Array.from(document.querySelectorAll('.day'));

		function dateIsSelected(e) {
			let thisDate = e.target;
			const otherDates = daysArray.filter(date => {
				return (date !== thisDate);
			})
			otherDates.forEach((e) => {
				e.classList.remove('date_selected')
			})
			thisDate.classList.add('date_selected')
			date.setDate(thisDate.innerHTML)
			fullDate.innerHTML = dateInFr(date)
			getTheSlots(date);
		}

		function timeIsSelected(e) {
			let thisTime = e.target;
			if (thisTime.classList.contains('time_selected')) {
				thisTime.classList.remove('time_selected');
			} else {
				thisTime.classList.add('time_selected');
			}
		}

		let callIt = false;
		let selectClass = 0;
		daysArray.forEach((day) => {
			if (day.classList.contains('date_selected')) {
				selectClass++
			}
			day.addEventListener('click', (e) => {
				if (e.target.classList.contains('prev_date')) {
					if (!callIt) {
						renderCalendar()
						dateIsSelected(e);
						date.setMonth(date.getMonth() - 1);
						callIt = true;
					}
				} else if (e.target.classList.contains('next_date')) {
					if (!callIt) {
						date.setMonth(date.getMonth() + 1);
						renderCalendar()
						dateIsSelected(e);
						callIt = true;
					}
				} else {
					date.setDate(day.innerHTML)
					if (!callIt) {
						callIt = true;
						dateIsSelected(e);
					}
				}
			})
		})

		if (!selectClass) {
			let whatDay = fullDate.innerHTML.split(' ').filter((e) => /^\d{1,2}$/.test(e)).join('');
			daysArray.forEach((day) => {
				if (day.innerHTML == whatDay && !day.classList.contains('prev_date') && !day.classList.contains('next_date')) {
					day.classList.add('date_selected')
				}
			})
		}

		timeArray.forEach((time) => {
			time.addEventListener('click', (e) => {
				timeIsSelected(e);
			})
		})
	}

	function prevMonth() {
		date.setMonth(date.getMonth() - 1);
		date = renderCalendar();
		fullDate.innerHTML = dateInFr(date);
		getTheSlots(date);
	}

	function nextMonth() {
		date.setMonth(date.getMonth() + 1);
		date = renderCalendar();
		fullDate.innerHTML = dateInFr(date);
		getTheSlots(date);
	}

	function getTheSlots(date) {
		let year = date.getFullYear();
		let month = ("0" + (date.getMonth() + 1)).slice(-2);
		let day = ("0" + date.getDate()).slice(-2);
		let formatedDate = year + "-" + month + "-" + day;
		
		let xhr = new XMLHttpRequest();
		let url = '<?= admin_url('admin-ajax.php') ?>';
		let dataSet = 'action=get_the_slots&date=' + formatedDate + '&week_day=' + date.getDay();

		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let result = xhr.responseText;
				result = JSON.parse(result);
				if (!result.error) {
					// console.log(result)
					showSlots(result)
				} else {
					console.log(result);
				}
			}
		};
		xhr.send(dataSet);
	}
	
	function showSlots(result) {			

		let slotsDisplay = "";
		let slots = document.querySelector('.slots');
		let allSlots = result.all_slots.map(e => e.time);
		let takenSlots = new Set(result.taken_slot);
		let slotSet = new Set(allSlots);

		takenSlots.forEach(slot => slotSet.add(slot));
		slotSet = Array.from(slotSet).sort();
		
		let selectedDate = new Date(date);
		let now = new Date();
		now.setHours(0, 0, 0, 0);
		
		if (selectedDate.getDay() === 0 || selectedDate.getDay() === 6 || selectedDate < now) {
			slotSet.forEach((e) => {
				slotsDisplay += `<div class="slot unavailable">${e}</div>`;
			});
		} else {
			slotSet.forEach((e) => {
				const unavailableClass = takenSlots.has(e) ? 'unavailable' : '';
				slotsDisplay += `<div class="slot ${unavailableClass}">${e}</div>`;
			});
		}		
		slots.innerHTML = slotsDisplay;
		handleSelection();
	}

	// FORMAT DATES :
	function dateInFr(date) {
		let selectedDate = new Date(date);
		let joursSemaine = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
		let mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
		let jourSemaine = joursSemaine[selectedDate.getDay()];
		let jour = selectedDate.getDate();
		let moisActuel = mois[selectedDate.getMonth()];
		let annee = selectedDate.getFullYear();
		return fullDateFr = jourSemaine + " " + jour + " " + moisActuel + " " + annee;
	}

	function formatDateWithSlashes(dateStr) {
		let date = new Date(dateStr);
		let jour = date.getDate();
		let mois = date.getMonth() + 1;
		let annee = date.getFullYear();
		let dateFormatee = jour.toString().padStart(2, '0') + '/' + mois.toString().padStart(2, '0') + '/' + annee;
		return dateFormatee;
	}


	// APPOINTEMENT TABLE HANDLER:
	function getAllAppointements(category = "") {

		let xhr = new XMLHttpRequest();
		let url = '<?= admin_url('admin-ajax.php') ?>';
		let data = 'action=get_all_appointements';
		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let result = xhr.responseText;
				result = JSON.parse(result);
				// console.log(result);
				if (!result.error) {
					showAllAppointement(result, category)
				} else {
					console.log(result);
				}
			}
		};
		xhr.send(data);
	}

	let pastBtn = document.querySelector('#past_appointement');
	let futureBtn = document.querySelector('#futur_appointement');
	let allBtn = document.querySelector('#all_appointement');

	function showAllAppointement(result, category) {

		let appointementsDisplay = document.querySelector('tbody');
		let table = document.querySelector('#appointement_table');
		table.style.display = "block";

		filterResult(result, category)


		let blue = "#33AAFF"

		if (category == "") {
			setButtonStyles(allBtn);
		} else if (category == "past_date") {
			setButtonStyles(pastBtn);
		} else {
			setButtonStyles(futureBtn);
		}

		pastBtn.addEventListener('click', e => {
			filterResult(result, "past_date");
			setButtonStyles(pastBtn);
		});

		futureBtn.addEventListener('click', e => {
			filterResult(result, "future_date");
			setButtonStyles(futureBtn);
		});

		allBtn.addEventListener('click', e => {
			filterResult(result, "");
			setButtonStyles(allBtn);
		});


		function filterResult(result, filter) {
			let newResult = "";
			if (filter != "") {
				newResult = result.filter(r => r.date_category == filter);
				displayAppointement(newResult)
				deletable(newResult, filter)
			} else {
				displayAppointement(result)
				deletable(newResult, filter)
			}
		}

		function setButtonStyles(activeBtn) {
			[pastBtn, futureBtn, allBtn].forEach(btn => {
				if (btn === activeBtn) {
					btn.style.backgroundColor = blue;
					btn.style.color = "white";
				} else {
					btn.style.backgroundColor = "white";
					btn.style.color = blue;
				}
			});
		}

		function displayAppointement(data) {
			appointementsDisplay.innerHTML = "";
			if (data.length > 0) {
				data.map((e) => {
					if (!/^\d{2}\/\d{2}\/\d{4}$/.test(e.date)) {
						e.date = formatDateWithSlashes(e.date);
					}
					appointementsDisplay.innerHTML +=
						`<tr class="appointement_row">    
										<td>${e.first_name}</td>
										<td>${e.last_name}</td>
										<td>${e.company}</td>
										<td><a href="mailto:${e.email}">${e.email}</a></td>
										<td><a href="tel:${e.phone}">${e.phone}</a></td>
										<td>${String(e.date)}</td>
										<td>${e.time}</td>
										<td><button class="delete_button" id="${e.id}">Delete</button></td>
									</tr>`
				})
			} else {
				appointementsDisplay.innerHTML +=
					`<tr class="appointement_row">    
										<td>&nbsp;--&nbsp;</td>
										<td>&nbsp;--&nbsp;</td>
										<td>&nbsp;--&nbsp;</td>
										<td>&nbsp;--&nbsp;</td>
										<td>&nbsp;--&nbsp;</td>
										<td>&nbsp;--&nbsp;</td>
										<td>&nbsp;--&nbsp;</td>
										<td>&nbsp;--&nbsp;</td>
									</tr>`
			}
		}

		function deletable(data, category) {
			document.querySelectorAll('.delete_button').forEach(e => {
				e.addEventListener('click', f => {

					let id = f.target.id
					let name = f.target.parentNode.parentNode.querySelector(':first-child');

					if (confirm(`Vous êtes sur de vouloir annuler le rdv de ${name.innerHTML}`)) {
						let xhrDelete = new XMLHttpRequest();
						let urlDelete = '<?= admin_url('admin-ajax.php') ?>';
						let dataDelete = 'action=cancel_demo_meeting_with_id&id=' + String(id);
						xhrDelete.open("POST", urlDelete, true);
						xhrDelete.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xhrDelete.onreadystatechange = function() {
							if (xhrDelete.readyState == 4 && xhrDelete.status == 200) {
								let result = xhrDelete.responseText;
								result = JSON.parse(result);
								if (!result.error) {
									// console.log(result);
									getAllAppointements(category)
								} else {
									console.log(result);
								}
							}
						};
						xhrDelete.send(dataDelete);
					}
				})
			})
		}
	};

	// handle blocking dates and slots :  	
	let blockSlot = document.querySelector('#block_slot');
	let blockDay = document.querySelector('#block_whole_day');
	let unblockSlot = document.querySelector('#unblock_slot');
	let unblockDate = document.querySelector('#unblock_whole_day');

	blockSlot.addEventListener('click', (e) => {
		e.preventDefault();

		let times = document.querySelectorAll('.time_selected');
		let day = document.querySelector('.date_selected');

		if (day == null || day == undefined) {
			alert("Il faut séléctioner un jour");
		} else if (times.length <= 0) {
			alert("Il faut séléctioner un créneau horaire");
		} else {

			blockSlot.disabled = true;

			let xhr = new XMLHttpRequest();
			let url = '<?= admin_url('admin-ajax.php') ?>';

			let timeArray = []
			times.forEach((time, i) => {
				timeArray.push(time.innerHTML)
			})

			let dataSet = 'action=block_slot_from_plugin&date=' + date.toDateString()  + '&time=' + timeArray;

			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					let result = xhr.responseText;
					result = JSON.parse(result);
					if (!result.error) {
						alert(result)
						getTheSlots(date)
						blockSlot.disabled = false;
					} else {
						console.log(result);
						blockSlot.disabled = false;
					}
				}
			};
			xhr.send(dataSet);
		}
	})


	unblockSlot.addEventListener('click', (e) => {
		e.preventDefault();
		let times = document.querySelectorAll('.time_selected');
		let day = document.querySelector('.date_selected');

		if (day == null || day == undefined) {
			alert("Il faut séléctioner un jour");
		} else if (times.length <= 0) {
			alert("Il faut séléctioner un créneau horaire");
		} else {

			unblockSlot.disabled = true;

			let xhr = new XMLHttpRequest();
			let url = '<?= admin_url('admin-ajax.php') ?>';

			let timeArray = []
			times.forEach((time, i) => {
				timeArray.push(time.innerHTML)
			})

			let dataSet = 'action=unblock_slot_from_plugin&date=' + date.toDateString() + '&time=' + timeArray

			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					let result = xhr.responseText;
					result = JSON.parse(result);
					if (!result.error) {
						result.forEach((e) => {
							if (e.first_name !== "BSA") {
								if (confirm('vous etes sur de vouloir effacer le rdv avec ' + e.first_name + ' ' + e.last_name + ' le ' + formatDateWithSlashes(e.date) + ' à ' + e.time + ' ?')) {
									let xhr = new XMLHttpRequest();
									let url = '<?= admin_url('admin-ajax.php') ?>';
									let dataSet = 'action=cancel_demo_meeting&first_name=' + e.first_name +
										'&last_name=' + e.last_name +
										'&date=' + date.toDateString() +
										'&time=' + e.time;
									xhr.open("POST", url, true);
									xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
									xhr.onreadystatechange = function() {
										if (xhr.readyState == 4 && xhr.status == 200) {
											let result = xhr.responseText;
											result = JSON.parse(result);
											if (!result.error) {
												alert(result);
											} else {
												console.log(result);
											}
										}
									};
									xhr.send(dataSet);
								}
							}
						})
						getAllAppointements();
						getTheSlots(date)
						unblockSlot.disabled = false;
					} else {
						console.log(result);
						unblockSlot.disabled = false;
					}
				}
			};
			xhr.send(dataSet);
		}
	})


	blockDay.addEventListener('click', (e) => {
		e.preventDefault();
		let day = document.querySelector('.date_selected');
		if (day == null || day == undefined) {
			alert("Il faut séléctioner un jour");
		} else {

			blockDay.disabled = true

			let xhr = new XMLHttpRequest();
			let url = '<?= admin_url('admin-ajax.php') ?>';
			let dataSet = 'action=block_day_from_plugin&date=' + date.toDateString() + '&week_day=' + date.getDay()

			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					let result = xhr.responseText;
					result = JSON.parse(result);
					if (!result.error) {
						// console.log(result);
						alert(result)
						getTheSlots(date)
						blockDay.disabled = false
					} else {
						console.log(result);
						blockDay.disabled = false;
					}
				}
			};
			xhr.send(dataSet);
		}
	})

	unblockDate.addEventListener('click', (e) => {
		e.preventDefault();
		let day = document.querySelector('.date_selected');
		if (day == null || day == undefined) {
			alert("Il faut séléctioner un jour");
		} else {

			unblockDate.disabled = true

			let xhr = new XMLHttpRequest();
			let url = '<?= admin_url('admin-ajax.php') ?>';
			let dataSet = 'action=unblock_day_from_plugin&date=' + date.toDateString();

			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					let result = xhr.responseText;
					result = JSON.parse(result);
					if (!result.error) {
						// console.log(result);
						alert(result)
						getTheSlots(date)
						unblockDate.disabled = false
					} else {
						console.log(result);
						unblockDate.disabled = false;
					}
				}
			};
			xhr.send(dataSet);
		}
	});


	// HANDLE CUSTOM WEEK DAYS :

	getAllDaysAndAllSlots();
	handleCustomWeekSelection();

	function getAllDaysAndAllSlots() {

		let xhr = new XMLHttpRequest();
		let url = '<?= admin_url('admin-ajax.php') ?>';
		let dataSet = 'action=get_all_days_and_all_slots';

		xhr.open("POST", url, true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && xhr.status == 200) {
				let result = xhr.responseText;
				result = JSON.parse(result);
				if (!result.error) {
					// console.log(result)
					showAllDaysAndAllSlots(result);
				} else {
					console.log(result);
				}
			}
		};
		xhr.send(dataSet);
	}

	function showAllDaysAndAllSlots(result) {
		let days = document.querySelector('#make_custom_selecter');
		let slots = document.querySelector('#make_custom_checkbox_container');
		let dayNamesFr = {
			1: "Lundi",
			2: "Mardi",
			3: "Mercredi",
			4: "Jeudi",
			5: "Vendredi",
			6: "Samedi",
			7: "Dimanche"
		}
		result.all_days.map((e) => {
			days.innerHTML += `<option value="${e.id}">${dayNamesFr[e.id]}</option>`
		})
		result.all_time_slots.map((e) => {
			slots.innerHTML +=
				`<div class="make_custom_checkbox">
					<input type="checkbox" class="checkbox" value="${e.id}">
					<label for="checkbox">${e.time}</label>
				</div>`
		})
	}

	function handleCustomWeekSelection() {
		let select = document.querySelector('#make_custom_selecter');
		select.addEventListener('change', (e) => {
			e.preventDefault();
			let xhr = new XMLHttpRequest();
			let url = '<?= admin_url('admin-ajax.php') ?>';
			let dataSet = 'action=get_slots_for_that_day&day=' + e.target.value;

			xhr.open("POST", url, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					let result = xhr.responseText;
					result = JSON.parse(result);
					if (!result.error) {
						// console.log(result);
						checkThoseSlots(result);
					} else {
						console.log(result);
					}
				}
			};
			xhr.send(dataSet);
		})
	};


	function checkThoseSlots(result) {
		let slots = document.querySelectorAll('.checkbox');
		let btn = document.querySelector('#custom_weekday_submit');
		let select = document.querySelector('#make_custom_selecter');
		let slotChecked = []

		slots.forEach((slot) => {
			slot.checked = false;
		})

		if (result.length > 0) {
			result.forEach((e) => {
				slots.forEach((slot) => {
					if (e.id == slot.value) {
						slot.checked = true;
						slotChecked.push(slot.value);
					};
				})
			})
		}

		btn.addEventListener('click', (e) => {
			e.preventDefault();

			let addArray = [];
			let removeArray = [];

			slots.forEach((slot) => {
				if (slot.checked) {
					if (!slotChecked.includes(slot.value)) {
						addArray.push(slot.value);
					}
				} else {
					if (slotChecked.includes(slot.value)) {
						removeArray.push(slot.value);
					}
				}
			})

			if (confirm("T'es sur ?")) {
				let xhr = new XMLHttpRequest();
				let url = '<?= admin_url('admin-ajax.php') ?>';
				let dataSet = 'action=customise_weekday&add=' + addArray + '&remove=' + removeArray + "&day=" + select.value;

				xhr.open("POST", url, true);
				xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4 && xhr.status == 200) {
						let result = xhr.responseText;
						result = JSON.parse(result);
						if (!result.error) {
							// console.log(result)
							if (!alert("Selection enregistrée")) {
								window.location = 'http://hulk-landing.local/wp/wp-admin/admin.php?page=calendar_handler';
							}
						} else {
							console.log(result);
						}
					}
				};
				xhr.send(dataSet);
			}
		})
	};
</script>