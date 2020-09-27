
export default class Calculator {
  constructor (node, juncture) {
    this.node = node;
    this.juncture = juncture;
  }

  render (data) {
    if (data.status === 'error') {
      return;
    }

    this.juncture.setInput(data.result);
    this.juncture.setLog(data.expression);
  }
}
