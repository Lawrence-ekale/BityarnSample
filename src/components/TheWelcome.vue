<template>
  
  <select v-model="whichLevel">
    <optgroup id="level">
      <option @click="getLevelData(1)">Country</option>
      <option @click="getLevelData(2)">County</option>
      <option @click="getLevelData(3)">Sub-County</option>
      <option @click="getLevelData(4)">Ward</option>
      <option @click="getLevelData(5)">Location</option>
    </optgroup>
  </select>

  <select v-model="nameSpecified">
    <optgroup id="sublevel">
      <option v-for="option in options" :key="option.id" :value="option.id" @click="showThis = true">
      {{ option.name }}
    </option>
    </optgroup>
  </select>

  <select id="nextAction" v-if="showThis" v-model="whichLevel1">
    <optgroup id="level">
      <option @click="getLevelDataJump(1)">View Country</option>
      <option @click="getLevelDataJump(2)">View County</option>
      <option @click="getLevelDataJump(3)">View Sub-County</option>
      <option @click="getLevelDataJump(4)">View Ward</option>
      <option @click="getLevelDataJump(5)">View Location</option>
    </optgroup>
  </select>

  <!--<select>
    <optgroup id="sublevel1" v-if="options2.length > 0">
      <option v-for="option in options2" :key="option.id" :value="option.id">
      {{ option.name }}
    </option>
    </optgroup>
  </select>-->

  <p v-if="options2.length > 0">
    <p v-for="option in options2" :key="option.id" :value="option.id">
      {{ option.name }}
    </p>
  </p>
</template>

<script>
import BackendService from '../services/Backend';
    export default {
    name: 'The_Welcome',
    props: {
      selectedTab: Number,
    },
    data () {
      return {
        showThis: false,
        nameSpecified: '',
        whichLevel: '',
        whichLevel1: '',
        location: '',
        ward: '',
        sub_county: '',
        county: '',
        options: [],
        options1: [],
        options2: []
        
      }
    },
    methods: {
      getLevelData(level) {
        let formData = new FormData();
          formData.append('name', level);
          formData.append('level', 0);
          BackendService.getLevels(formData).then((response) => {
            this.options = response.data.payload
        })
      },
      getSubLevelData(id) {
        console.log("This id" + id + " The name chosen is " + this.nameSpecified);
        let formData = new FormData();
          formData.append('id', this.nameSpecified);
          formData.append('sub_level', this.whichLevel);
          BackendService.getLevelsSub(formData).then((response) => {
            this.options1 = response.data.payload
        })
      },
      getLevelDataJump(id) {
        console.log(" The name id chosen is " + this.nameSpecified + " ANd level -> "+this.whichLevel+ "To view ->" +this.whichLevel1);
        let formData = new FormData();
          formData.append('id', this.nameSpecified);
          formData.append('level1',this.whichLevel);
          formData.append('sub_level_to_view', this.whichLevel1);
          BackendService.getLevelsSub(formData).then((response) => {
            this.options2 = response.data.payload
        })
      },
      getWard() {
        this.location = '';
        this.sub_county = '';
        this.county = '';
        document.getElementById('name').innerHTML = ''
            document.getElementById('ward').innerHTML = ''
            document.getElementById('county').innerHTML = ''
            document.getElementById('sub_county').innerHTML = ''
            document.getElementById('country').innerHTML = ''
        let formData = new FormData();
          formData.append('name', this.ward);
          formData.append('ward', 0);
          BackendService.getWard(formData).then((response) => {
            console.log(response.data.payload);
          if(response.data.status === 'success') {
            document.getElementById('name').innerHTML = ''
            document.getElementById('ward').innerHTML = response.data.payload[0].ward_name
            document.getElementById('county').innerHTML = response.data.payload[0].sub_county_name
            document.getElementById('sub_county').innerHTML = response.data.payload[0].county_name
            document.getElementById('country').innerHTML = response.data.payload[0].country_name
          }
        })
      },
    },

  }
</script>
