<template>
  <v-form
    class="form"
    @submit.prevent="submitContactForm"
  >
    <v-row>
      <v-col
        cols="12"
        sm="6"
      >
        <v-text-field
          v-model="state.firstname"
          :label="t('contact.form.firstname')"
          variant="outlined"
          :error="v$.firstname.$error"
          :error-messages="errors.firstname"
          clearable
          required
        />
      </v-col>

      <v-col
        cols="12"
        sm="6"
      >
        <v-text-field
          v-model="state.lastname"
          :label="t('contact.form.lastname')"
          variant="outlined"
          :error="v$.lastname.$error"
          :error-messages="errors.lastname"
          color="white"
          clearable
          required
        />
      </v-col>
    </v-row>

    <v-row>
      <v-col
        cols="12"
        sm="6"
      >
        <v-text-field
          v-model="state.email"
          type="email"
          :label="t('contact.form.email')"
          variant="outlined"
          :error="v$.email.$error"
          :error-messages="errors.email"
          clearable
          required
        />
      </v-col>
      <v-col
        cols="12"
        sm="6"
      >
        <v-text-field
          v-model="state.confirmEmail"
          type="email"
          :label="t('contact.form.confirmEmail')"
          variant="outlined"
          :error="v$.confirmEmail.$error"
          :error-messages="errors.confirmEmail"
          clearable
          required
        />
      </v-col>
    </v-row>

    <v-row>
      <v-col
        cols="12"
        sm="6"
      >
        <v-select
          v-model="state.topic"
          clearable
          text-align="left"
          :label="t('contact.form.topic')"
          :items="optionsTopic"
          item-title="value"
          item-value="key"
          variant="outlined"
        />
      </v-col>

      <v-col
        cols="12"
        sm="6"
      >
        <v-select
          v-model="state.country"
          clearable
          text-align="left"
          :label="t('contact.form.country')"
          :items="optionsCountries"
          item-title="value"
          item-value="key"
          variant="outlined"
        />
      </v-col>
    </v-row>

    <v-row>
      <v-col
        cols="12"
        sm="12"
      >
        <v-textarea
          v-model="state.message"
          variant="outlined"
          :label="t('contact.form.message')"
          :error="v$.message.$error"
          :error-messages="errors.message"
        />
      </v-col>
    </v-row>

    <vue-hcaptcha
      :sitekey="hrecaptchaSiteKey"
      theme="dark"
      @verify="handleHcaptchaVerify"
    />

    <v-text-field
      v-model="state.honeypot"
      :style="{
        position: 'absolute',
        top: 0,
        left: 0,
        zIndex: -1,
        width: 0,
        height: 0,
        opacity: 0,
      }"
    />

    <v-row>
      <v-col
        cols="12"
        sm="12"
        align-self="center"
      >
        <v-btn
          type="submit"
          block
          size="x-large"
          variant="outlined"
          class="text-white mr-5"
          aria-label="{{ $t('layout.submit')}}"
        >
          {{ $t('layout.submit') }}
        </v-btn>
      </v-col>
    </v-row>
  </v-form>
</template>

<script setup>
import {computed, reactive, ref} from "vue";

// I18n
import { useI18n } from "vue-i18n";
const { t } = useI18n();

// VueValidate
import { useVuelidate } from '@vuelidate/core';
import { required, email, minLength, sameAs } from '@vuelidate/validators'

//Recaptcha
import { hcaptcha } from "@/configs/captcha";
import VueHcaptcha from '@hcaptcha/vue3-hcaptcha';

import { contactTopics } from "@/configs/contactTopics";
import listCountries from "@/services/listCountries";

const optionsTopic = ref(contactTopics);
const optionsCountries = ref(listCountries);
const hrecaptchaSiteKey = ref(hcaptcha.siteKey);
const hVerified = ref(false);

const state = reactive({
  firstname: '',
  lastname: '',
  email: '',
  confirmEmail: '',
  topic: null,
  country: null,
  message: '',
  honeypot: null
});


const minRequiredLength = ref(2);
const validations = {
  lastname: {
    required,
    minLength: minLength(minRequiredLength.value)
  },
  firstname: {
    required,
    minLength: minLength(minRequiredLength.value)
  },
  email: {
    required,
    email
  },
  confirmEmail: {
    required,
    email,
    sameAsRef: sameAs(computed(() => state.email))
  },
  topic: {
    required
  },
  message: {
    required
  }
};
const v$ = useVuelidate(validations, state, { $lazy: true });

const errors = computed(() =>  {
  const errors = v$.value.$errors;
  return (0 < errors.length)
    ?
    errors.reduce((acc, value) => {
      return {...acc, [value.$property]: value.$message}
    })
    : []
})

const handleHcaptchaVerify = () => {
  hVerified.value = true;
}

const emit = defineEmits(['submit-form']);
const submitContactForm = async () => {
  const result = await v$.value.$validate()
  if (!result && !hVerified.value && null === state.honeypot) {
    return;
  }

  v$.value.$reset();
  emit('submit-form', {...state});
}
</script>

<style scoped>

</style>

