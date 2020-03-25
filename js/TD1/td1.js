'use strict'

function min(a,b) {
  return (a<b) ? a : b;
}

function max(a,b){
    return (a>b) ? a : b;
}

function power(x, n){
    for (let i = 0; i < n; i++) {
      x* power(x,n-1)
    }
    return a;
}

for (let i = 0; i < 100; i++) {
  console.log(i)
  if(i% 5 == 0){
    console.log("yooo");
  }
  if(i == 73){
    console.log("Biinngooo");
  }
}

console.log("Min entre 224 et 42 : " + min(224,42));
console.log("Max entre 0.1 et 0.009 : " + max(0.1,0.009));
console.log("10 Puissance 7 : " + power(10,7));
