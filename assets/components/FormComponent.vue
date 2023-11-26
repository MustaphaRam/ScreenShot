<template>
  <div class="container mx-auto m-5">
    <h2 class="h2">Screen Shot</h2>
    <div class="row m-5">
      <form @submit.prevent="submitForm">
          <div class="row">
              <div class="col-xl-9">
                <label for="URL" class="form-label required">URL</label>
                <input type="text" class="form-control" v-model="formData.url" id="url" name="url" :disabled="isLoad" @input="validateUrl" placeholder="Enter URL" required>
                <p v-if="!isValidUrl && formData.url" style="color: red;">Invalid URL</p>
              </div>
              <div class="col-xl-3">
                  <label for="screen_size" class="form-label required">Size</label>
                  <select v-model="formData.size" name="size" class="form-select" required>
                      <option selected value="600">600px</option>
                      <option value="800">800px</option>
                      <option value="1080">1080px</option>
                  </select>
              </div>
          </div>
          <div class="py-3">
            <button v-if="!isLoad" type="submit" class="btn btn-primary" :disabled="!isValidUrl">Capture</button>
            <button v-if="isLoad" class="btn btn-primary" type="button">
              <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
              <span role="status">Loading...</span>
            </button>
          </div>
        </form>
    </div>
    <div class="row">
      <div class="container p-5">
          <div class="text-center" style="margin: 0 12%;">
            <span v-if="!screenshot && !isLoad" style="color: red; font-weight: bold;">No found</span>
            <div v-if="isLoad" class="spinner-grow text-primary" role="status">
              <span class="visually-hidden"> Loading...</span>
            </div>
            <div v-if="screenshot" class="d-flex align-items-center border p-3">
              <div class="p-2 w-100">
                <img :src="screenshot" :alt="formData.url" class="img-thumbnail float-start" style="width: 250px;">
              </div>
              <div class="p-2 flex-shrink-1">
                <button @click="downloadFile" class="btn btn-outline-primary" type="button">Download</button>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import validator from 'validator';

  export default {
    data() {
      return {
        formData: {size: 600},
        isValidUrl: false,
        screenshot: null,
        message: null,
        isLoad: false,
      };
    },
    methods: {
      validateUrl() {
        this.isValidUrl = validator.isURL(this.formData.url);
      },
      async submitForm() {
        if (this.isValidUrl) {
          try {
            this.screenshot= null;
            this.isLoad = true;
            axios.post('/Scraping', this.formData).then(response => {
                this.screenshot = response.data['image_bass64'];
                console.log(response.data['message']);
                this.isLoad = false;
            }).catch(error=> {
              this.message = 'error';
              console.log(error);
            });
          } catch (error) {
            this.isLoad = false;
            console.error('Error capturing or fetching screenshot:', error);
          }
        }
      },
      downloadFile() {
        if (this.screenshot) {
          const filename = this.formData.url+'.jpg';
          // Create an anchor element and set its href to the download URL
          const anchor = document.createElement('a');
          anchor.href = this.screenshot;
          anchor.download = filename;
          // Trigger the download
          anchor.click();
        }
      },
    },
  };
</script>
