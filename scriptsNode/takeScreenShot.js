const puppeteer = require('puppeteer');

// Function to take a screenshot and return as base64
function takeScreenshotBase64(url, size) {
  try {
    (async () => {
      const browser = await puppeteer.launch({headless: "new"});
      const page = await browser.newPage();
      await page.setViewport({width: size, height: size-100});
      await page.goto(url, { waitUntil: 'domcontentloaded' });
      const img_basr64 = await page.screenshot({ encoding : 'base64' });
      await browser.close();
      return console.log(img_basr64);
    })();
  } catch (e) {
      return console.log("-");
  }
}

// Usage example
const url = process.argv[2];
const size = parseInt(process.argv[3]);
takeScreenshotBase64(url, size);
