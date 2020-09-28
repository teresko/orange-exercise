
import Juncture from './Component/Juncture.js';
import Calculator from './Component/Calculator.js';
import Memory from './Component/Memory.js';


const juncture = new Juncture(
  document.querySelector('[data-component="input"]'),
  document.querySelector('[data-component="log"]'),
  document.querySelector('[data-component="error"]')
);

const calculator = new Calculator(
  document.querySelector('[data-component="calculator"]'),
  juncture
);

const memory = new Memory(
  document.querySelector('[data-component="memory"]'),
  document.querySelector('#snippet')
);

const handle = function (data) {
  if (data.status === 'ok') {
    calculator.render(data);
    memory.add(data);
  } else {
    juncture.error(data.message);
  }
};

const restore = function (data) {
  data.items.slice().reverse().forEach(memory.add.bind(memory));
  juncture.clear();
}

calculator.node.addEventListener('submit', function (event) {
  event.preventDefault();

  const params = {
    method: 'POST',
    body: new FormData(event.target)
  };

  fetch('/api/equations', params)
    .then(data => data.json())
    .then(handle);
}, false);

calculator.node.addEventListener('click', function (event) {
  const element = event.target;
  if (element.classList.contains('log')) {
    juncture.swap();
  }

  if (element.classList.contains('key')) {
    juncture.write(element.value);
  }
}, false);

memory.node.addEventListener('click', function (event) {
  const slot = event.target;
  if (slot.classList.contains('empty')) {
    return;
  }

  memory.populate(juncture, slot);
}, false);

juncture.input.addEventListener('focus', juncture.reset.bind(juncture), false);

fetch('/api/equations')
  .then(data => data.json())
  .then(restore);
