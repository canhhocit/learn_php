function add_child() {
  var p = document.createElement("p");

  var node = document.createTextNode("Some new text");
  p.appendChild(node);

  p.style.backgroundColor = "red";
  p.style.padding = "10px";
  p.style.color = "white";

  var div = document.getElementById("demo");
  div.appendChild(p);
}

function insole() {
  let number = document.getElementById("num");
  let n = number.value.trim();
  if (n === "") {
    alert("Bạn chưa nhập số !!!");
    return;
  }
  n = Number(n);

  let div = document.getElementById("so");
  //div.innerHTML = "";

  for (let i = 1; i < n; i += 2) {
    let p = document.createElement("p");
    p.style.color = "blue";
    p.style.fontSize = "30px";
    p.style.backgroundColor = "green";

    p.innerText = i;
    div.appendChild(p);
  }
}

var nhom = [
  [1, "trần dần"],
  [2, "trần hà linh"],
  [3, "trình hà lân"],
];

let body = document.getElementById("table-body");

for (let i = 0; i < nhom.length; i++) {
  let row = document.createElement("tr"); 

  let cellId = document.createElement("td"); 
  cellId.textContent = nhom[i][0];

  let cellName = document.createElement("td"); 
  cellName.textContent = nhom[i][1];

  row.appendChild(cellId);
  row.appendChild(cellName);

  body.appendChild(row);
}
function changecolor() {
  let btndk = document.getElementById("btn");
  btndk.addEventListener("mouseover", function () {
    this.style.backgroundColor = "yellow";
  });
}
