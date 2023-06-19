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

  <p v-if="options2.length > 0">
    <p v-for="option in options2" :key="option.id" :value="option.id">
      {{ option.name }}
    </p>
  </p>
  <p v-else id="repeat">

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
        options: [],
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
      getLevelDataJump(id) {
        console.log(" The name id chosen is " + this.nameSpecified + " ANd level -> "+this.whichLevel+ "To view ->" +this.whichLevel1);
        let formData = new FormData();
          formData.append('id', this.nameSpecified);
          formData.append('level1',this.whichLevel);
          formData.append('sub_level_to_view', this.whichLevel1);

          
          if(!this.whichLevel1.includes(this.whichLevel)) {
            BackendService.getLevelsSub(formData).then((response) => {
              
              this.options2 = response.data.payload
          })
        } else {
          //this.options2 = ['name' = this.whichLevel];
          var rightOne = this.options.filter((option)=> {
            return option.id == this.nameSpecified ? option : null
          });
          console.log(rightOne[0].name);
          document.getElementById('repeat').innerHTML = rightOne[0].name
        }
      },
    },

  }
</script>
