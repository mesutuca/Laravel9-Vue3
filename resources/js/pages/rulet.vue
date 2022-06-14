<template>
  <div class="grid grid-cols-2 w-full justify-center gap-4 w-[60rem]">
    <div class="w-full">
      <div class="flex flex-row space-x-10">
        <div class="hot flex flex-col ">
          <label for="">Sıcak Sayılar</label>
          <div>
            <input class="shadow appearance-none border rounded w-10 py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   type="text"
                   @keypress="isNumber($event)"
                   data-number=""
                   data-color=""
                   min="0" max="36" maxlength="2"
                   v-for="listhot in hot" :key="listhot" v-model.number="listhot.number"
            >
          </div>
        </div>
        <div class="hot flex flex-col">
          <label for="">Soğuk Sayılar</label>
          <div>
            <input
                class="shadow appearance-none border rounded w-10 py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text"
                @keypress="isNumber($event)"
                data-number=""
                data-color=""
                min="0" max="36" maxlength="2"
                v-for="listcold in cold" :key="listcold" v-model="listcold.number">
          </div>
        </div>
      </div>
      <div class="flex flex-col">
        <label for="">Çarkın Dönüş Yönü</label>
        <div class="flex justify-start flex-row w-full">
          <div class="flex w-full items-center justify-start">
            <input type="radio" id="one" value="true" v-model="picked">
            <label for="one">Saat Yönünde</label>
          </div>
          <div class="flex w-full items-center justify-start">
            <input type="radio" id="two" value="false" v-model="picked">
            <label for="two">Saatin Tersi</label>
          </div>
        </div>
      </div>
      <span>Picked: {{ picked }}</span>
      {{ gelensayilar }}
      <div class="grid grid-cols-13 w-full justify-center text-center">
        <div class="border text-2xl text-white" :class="colordata[`${list}`]"
             v-for="list in jsondata">{{ list }}
        </div>
      </div>
    </div>
    <div class="w-full">
      <div class="rulet border">
        <div class="flex w-full flex-row">
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-green-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="green"
               data-number="0">0
          </div>
        </div>
        <div class="flex w-full flex-row">
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="1">1
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="2">2
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="3">3
          </div>
        </div>
        <div class="flex w-full flex-row">
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="4">4
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="5">5
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="6">6
          </div>
        </div>
        <div class="flex w-full flex-row">
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="7">7
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="8">8
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="9">9
          </div>
        </div>
        <div class="flex w-full flex-row">
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="10">10
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="11">11
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="12">12
          </div>
        </div>
        <div class="flex w-full flex-row">
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="13">13
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="14">14
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="15">15
          </div>
        </div>
        <div class="flex w-full flex-row">
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="16">16
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="17">17
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="18">18
          </div>
        </div>
        <div class="flex w-full flex-row">
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="19">19
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="20">20
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="21">21
          </div>
        </div>
        <div class="flex w-full flex-row">
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="22">22
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="23">23
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="24">24
          </div>
        </div>
        <div class="flex w-full flex-row">
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="25">25
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="26">26
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="27">27
          </div>
        </div>
        <div class="flex w-full flex-row">
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="28">28
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="29">29
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="30">30
          </div>
        </div>
        <div class="flex w-full flex-row">
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="31">31
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="32">32
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="33">33
          </div>
        </div>
        <div class="flex w-full flex-row">
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="34">34
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-black h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="black"
               data-number="35">35
          </div>
          <div class="flex w-full border border-white justify-center items-center text-center text-white bg-red-700 h-[4rem] font-bold text-xl"
               @click="gelenSayi($event)"
               data-color="red"
               data-number="36">36
          </div>
        </div>

      </div>
    </div>
  </div>
  <button @click="encok()">btonn</button>
</template>

<script>
import jsond from './ruleti.json';

export default {
  name: "rulet",
  data() {
    return {
      jsondata: jsond,
      picked: 'true',
      hot: [],
      cold: [],
      gelensayilar: [],
      colordata: {
        0: 'bg-green-700',
        1: 'bg-red-700',
        2: 'bg-black',
        3: 'bg-red-700',
        4: 'bg-black',
        5: 'bg-red-700',
        6: 'bg-black',
        7: 'bg-red-700',
        8: 'bg-black',
        9: 'bg-red-700',
        10: 'bg-black',
        11: 'bg-black',
        12: 'bg-red-700',
        13: 'bg-black',
        14: 'bg-red-700',
        15: 'bg-black',
        16: 'bg-red-700',
        17: 'bg-black',
        18: 'bg-red-700',
        19: 'bg-red-700',
        20: 'bg-black',
        21: 'bg-red-700',
        22: 'bg-black',
        23: 'bg-red-700',
        24: 'bg-black',
        25: 'bg-red-700',
        26: 'bg-black',
        27: 'bg-red-700',
        28: 'bg-black',
        29: 'bg-black',
        30: 'bg-red-700',
        31: 'bg-black',
        32: 'bg-red-700',
        33: 'bg-black',
        34: 'bg-red-700',
        35: 'bg-black',
        36: 'bg-red-700',
      }
    }
  },
  watch: {},
  methods: {
    encok() {
      let map = new Map();
      for (let i = 0; i < this.jsondata.length; i++) {
        let count = map.has(this.jsondata[i]) ? map.get(this.jsondata[i]) + 1 : 1;
        map.set(this.jsondata[i], count)
      }

      /* Convert the Map into an array of arrays and sort by the 'count'*/
      const sorted = [...map].sort((first, second) => first[1] - second[1]);

      /* first five element are the ones that occur the least */
      let fiveLeast = sorted.slice(0, 5);

      /* last five are the ones that occur the most */
      let fiveMost = sorted.slice(-5);
      fiveLeast.map(e => this.cold.push({
        number: e[0]
      }))

      fiveMost.map(e => this.hot.push({
        number: e[0]
      }))
      /* drop the .map(e => e[0]) part if you want to see the number of times the respective elements occur */
      console.log("These five occur the least: [" + fiveLeast.map(e => e[0]) + "]");
      console.log("These five occur the most: [" + fiveMost.map(e => e[0]) + "]");
    },
    gelenSayi(event) {

      const element = event.target;
      this.picked = !this.picked
      const number = element.getAttribute('data-number');
      const color = element.getAttribute('data-color');
      // this.gelensayilar.push({
      //   sayi: number,
      //   color: color
      // })
      this.jsondata.unshift(number)
      // this.jsondata.push(number)
      // let id = this.jsondata.length + 1
      // const i = Math.round(Math.random() * this.jsondata.length)
      // this.jsondata.splice(i, 0, id)

    },
    isNumber: function (evt) {
      evt = (evt) ? evt : window.event;
      const charCode = (evt.which) ? evt.which : evt.keyCode;
      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();
      } else {
        return true;
      }
    }
  }
}
</script>

<style scoped>
.grid-cols-13 {
  grid-template-columns: repeat(13, minmax(0, 1fr));
}
</style>