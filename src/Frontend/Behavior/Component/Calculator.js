
export default class Calculator {
  constructor (node, juncture) {
    this.node = node;
    this.juncture = juncture;
  }

  render (data) {
    this.juncture.setInput(data.result);
    this.juncture.setLog(data.expression);
  }
}
