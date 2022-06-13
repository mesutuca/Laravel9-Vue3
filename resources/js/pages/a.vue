<template>
  <div class="flex flex-col space-y-8">
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
</template>

<script>
export default {
  name: "a",
  data() {
    return {
      picked: 'true',
      hot: [
        {
          number: ''
        },
        {
          number: ''
        },
        {
          number: ''
        },
        {
          number: ''
        },
        {
          number: ''
        }
      ],
      cold: [
        {
          number: ''
        },
        {
          number: ''
        },
        {
          number: ''
        },
        {
          number: ''
        },
        {
          number: ''
        }
      ],
      gelensayilar: []
    }
  },
  watch: {},
  methods: {
    gelenSayi(event) {
      const element = event.target;
      this.picked = !this.picked
      const number = element.getAttribute('data-number');
      const color = element.getAttribute('data-color');
      this.gelensayilar.push({
        sayi: number,
        color: color
      })

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

</style>