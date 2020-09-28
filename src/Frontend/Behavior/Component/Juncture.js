
export default class Juncture {
  constructor (input, log, message) {
    this.input = input;
    this.log = log;
    this.message = message;
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
    this.reset();
    if (fragment === '=') {
      return;
    }
    if (!is_numeric(fragment)) {
      this.input.value = this.input.value.trim();
      fragment = ' ' + fragment + ' ';
    }
    this.input.value += fragment;
  }

  clear () {
    this.input.value = ''
    this.log.textContent = '';
  }

  error (content) {
    this.message.textContent = content;
    this.message.classList.remove('hidden');
  }

  reset () {
    this.message.classList.add('hidden');
  }
}

const is_numeric = function (char) {
    return /[\d\.]/.test(char);
};
