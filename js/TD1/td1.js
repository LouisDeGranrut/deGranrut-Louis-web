'use strict'

function min(a,b) {
  return (a<b) ? a : b;
}

function max(a,b){
    return (a>b) ? a : b;
}

for (let i = 0; i < 100; i++) {
  console.log(i)
}

console.log("Min entre 224 et 42 : " + min(224,42));
console.log("Max entre 0.1 et 0.009 : " + max(0.1,0.009));
