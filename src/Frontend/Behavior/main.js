
import Juncture from './Component/Juncture.js';
import Calculator from './Component/Calculator.js';
import Memory from './Component/Memory.js';


const juncture = new Juncture(
  document.querySelector('[data-component="input"]'),
  document.querySelector('[data-component="log"]')
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
  calculator.render(data);
  memory.add(data);
};

const restore = function (data) {
  data.items.slice().reverse().forEach(memory.add.bind(memory));
}

calculator.node.addEventListener('submit', function (event) {
  event.preventDefault();

  const params = {
    method: 'POST',
    body: new FormData(this)
  };

  fetch('/api/equations', params)
    .then(data => data.json())
    .then(handle);
}, false);

calculator.node.addEventListener('click', function (event) {
  const slot = event.target;
  if (slot.classList.contains('log')) {
    juncture.swap();
  }
}, false);

memory.node.addEventListener('click', function (event) {
  const slot = event.target;
  if (slot.classList.contains('empty')) {
    return;
  }

  memory.populate(juncture, slot);
}, false);

fetch('/api/equations')
  .then(data => data.json())
  .then(restore);
