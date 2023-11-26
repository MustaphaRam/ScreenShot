# screenShot

[![Symfony](https://img.shields.io/badge/Symfony-%5E6.0-blueviolet)](https://symfony.com/)
[![Vue.js](https://img.shields.io/badge/Vue.js-%5E3.0-brightgreen)](https://vuejs.org/)

## Description

This project is a web application built with Symfony on the backend and Vue.js on the frontend. 
It allows users to capture screenshots of websites by providing the URL and specifying the desired image size.

## Features

- **Screenshot Capture:** Users can input a website URL and specify the size of the image they want.
- **Image Download:** Captured screenshots are displayed to the user with the option to download them.

## Technologies Used

- [Symfony](https://symfony.com/) - PHP framework for the backend.
- [Vue.js](https://vuejs.org/) - JavaScript framework for the frontend.
- [Puppeteer](https://github.com/puppeteer/puppeteer) - Headless browser automation library for capturing screenshots.

## Requirements

- PHP (>=8.0)
- Composer
- Node.js
- Yarn or npm

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/MustaphaRam/screenShot.git```

  2. Install PHP dependencies:

  ```bash
  composer install```
  Install JavaScript dependencies:

  ```bash
  yarn install
  # or 
  npm install```
Build the frontend assets:

```bash
yarn build
# or 
npm run build```
Configure your environment variables:

Create a .env.local file in the project root and configure the necessary variables, including database settings, if applicable.

Set up the database (if applicable):

```bash
symfony serve```
The application will be accessible at http://localhost:8000.

Usage
Access the application in your web browser.
Enter the desired URL and image size.
Click the "Capture" button.
View the captured screenshot.
Optionally, download the screenshot.
Contributing
Contributions are welcome! Fork the repository, make your changes, and submit a pull request.

License
This project is licensed under the MIT License - see the LICENSE file for details.

vbnet
This is a basic template, and you might want to expand it based on your project's specific str

![image](https://github.com/MustaphaRam/screenShot/assets/125461674/b14cb4cc-10f2-4c40-b0e8-1134a94163a1)
