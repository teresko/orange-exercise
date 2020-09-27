
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
}
