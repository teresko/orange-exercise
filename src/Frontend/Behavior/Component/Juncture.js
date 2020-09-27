
export default class Juncture {
  constructor (input, log) {
    this.input = input;
    this.log = log;
  }

  setInput (value) {
    this.input.value = value;
  }

  setLog (value) {
    this.log.textContent = value;
  }

  swap () {
    const value = this.input.value;
    this.input.value = this.log.textContent
    this.log.textContent = value;
  }

  write (fragment) {
    if (fragment === '=') {
      return;
    }
    if (!is_numeric(fragment)) {
      this.input.value = this.input.value.trim();
      fragment = ' ' + fragment + ' ';
    }
    this.input.value += fragment;
  }
}

const is_numeric = function (char) {
    return /[\d\.]/.test(char);
};
