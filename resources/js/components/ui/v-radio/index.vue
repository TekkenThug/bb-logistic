<template>
  <label class="wrapper flex items-center">
    {{label}}

    <input
      class="checkbox"
      type="radio"
      :checked="isChecked"
      :value="value"
      @change="$emit('change', $event.target.value)"
    />

    <span class="checkmark"></span>
  </label>
</template>

<script>
export default {
  name: 'VRadio',

  model: {
    prop: 'modelValue',
    event: 'change'
  },

  props: {
    label: {
      type: String,
      default: "",
      required: true
    },

    modelValue: {
      default: "" 
    },

    value: {
      type: String,
      default: undefined
    }
  },

  computed: {
    isChecked() {
      return this.modelValue == this.value
    }
  }
}
</script>

<style lang="scss" scoped>
.wrapper {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 6px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  font-size: 16px;
}

.wrapper input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 21px;
  width: 21px;
  border-radius: 50%;
  background-color: #eee;
  border: 1px solid #ccc;
  transition: all .3s ease;
}

.wrapper:hover input ~ .checkmark {
  background-color: #ccc;
}

.wrapper input:checked ~ .checkmark {
  background-color: #0f5b9e;
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

.wrapper input:checked ~ .checkmark:after {
  display: block;
}

.wrapper .checkmark:after {
  top: 5px;
  left: 5px;
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: white;
}
</style>