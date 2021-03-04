# dailysunaura
Sunlight Illustration Generator

PHP Web Application with Bootstrap 4 and MySQL

*** IMP: this project won't work for you unless you obtain your own API key from openweathermap.org, and dowload Composer and Guzzle.  Please check out this YouTube walkthrough to see the project in greater detail: https://youtu.be/rwOJTNuAb2g ***

Daily Sun Aura is a web application I created that uses a web service (API) to illustrate the amount of daily sunlight in the selected location (zip code). Colors and images (that I created in Photoshop) are chosen randomly within the parameters of: if it's clear or cloudy, and the total number of daylight hours of the current day. The images are colorized with CSS, rotated semi-randomly, and layered, creating a unique aura!

The user can click on the aura to generate another aura (fun!) that uses the same inputs, or go back to try generating from another location (zip code).

Daily Sun Aura also includes a password protected admin page. The admin page contains utilities to select and add more sets of colors to the database, delete sets of colors, and test the auras (shows all aura information).

Reference: I used a Stack Overflow page that taught me how to "colorize" an image which greatly influenced this project: https://stackoverflow.com/questions/29458666/emulate-photoshops-color-overlay-using-css-filters

Created by Sadie Sturgeon, December 2020

<img src="readmeImages/index01.png" alt="Opening webpage with zipcode input">

<img src="readmeImages/index02.png" alt="Sun aura example number 1">

<img src="readmeImages/index03.png" alt="Sun aura example number 2">

<img src="readmeImages/security.png" alt="Password protection example">

<img src="readmeImages/admin.png" alt="Admin main webpage">

<img src="readmeImages/deletecolors.png" alt="Delete colors webpage that shows color tables">

<img src="readmeImages/deletecolors01.png" alt="Delete colors confirmation">

<img src="readmeImages/deletecolors02.png" alt="Delete colors success message">

<img src="readmeImages/addcolors.png" alt="Add colors form">

<img src="readmeImages/addcolors01.png" alt="Add colors webpage">

<img src="readmeImages/addcolors02.png" alt="Add colors webpage with dev tools open">

<img src="readmeImages/testing01.png" alt="Initial testing auras form">

<img src="readmeImages/testing02.png" alt="Testing auras webpage number 1">

<img src="readmeImages/testing03.png" alt="Testing auras webpage number 2">

<img src="readmeImages/testing04.png" alt="Testing auras webpage number 3">

<img src="readmeImages/testing05.png" alt="Testing auras webpage number 4">

<img src="readmeImages/testing06.png" alt="Testing auras webpage number 5">
