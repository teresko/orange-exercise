
export default class Memory {
  constructor (node, template) {
    this.node = node;
    this.template = template;
  }

  add (entry) {
    let element = document.importNode(this.template.content, true);

    element.querySelector('[data-expression]').textContent = entry.expression;
    element.querySelector('[data-result]').textContent = entry.result;

    this.node.removeChild(this.node.lastElementChild);
    this.node.prepend(element);
  }

  populate (juncture, element) {
    juncture.setInput(element.querySelector('[data-result]').textContent);
    juncture.setLog(element.querySelector('[data-expression]').textContent)
  }
}
