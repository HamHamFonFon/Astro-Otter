<script setup>
import {computed, toRefs} from "vue";

const props = defineProps({
  title: {
    type: String,
    default: ''
  },
  urlImage: {
    type: String,
    default: ''
  },
  user: {
    type: String,
    default: ''
  },
  showButton: {
    type: Boolean,
    default: false
  }
});

const { title, urlImage, user, showButton } = toRefs(props);
const backgroundColor = computed(() => (screen.width <= 760) ? 'primary': 'transparent')

const { isMobile } = useDevice();

const getHeight = () => {
  return (window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight)+64;
}

const scrollToDsoData = () => {
  document.getElementById('dsoBlocks').scrollIntoView({ behavior: "smooth" });
}

</script>
<template>
  <v-parallax
    cover
    :src="urlImage"
    :height="getHeight()"
  >
    <v-row
      class="w-auto fill-height"
      align="center"
      justify="center"
    >
      <div class="text-h2 text-white">
        <h2 :class="!isMobile ? 'text-h2 text-white' : 'text-h4 text-white'">
          {{ title }}
        </h2>
        <h4
          v-if="user"
          class="text-h6 subheading"
        >
          &#169; {{ user }}
        </h4>
      </div>

      <v-btn
        v-if="showButton"
        class="scrollDown"
        width="50"
        :color="backgroundColor"
        block
        size="large"
        @click="scrollToDsoData"
      >
        <v-icon
          color="green"
          icon="mdi-arrow-down"
        />
      </v-btn>
    </v-row>
  </v-parallax>
</template>

<style scoped>
.scrollDown {
  opacity: 1;
  visibility: visible;
  position: fixed;
  bottom: 1em;
  z-index: 999;
  margin: auto;
  width: 2em;
  border-radius: 0.5rem;
  box-shadow: 1px 1px 9px #1ed760;
  transition: all 0.5s;
  cursor: pointer;
}
</style>

<!--      :src="isHovering ? image.urlHdSolution : image.urlHd" -->
<!--      @mouseover="isHovering = true" @mouseout="isHovering = false"-->
