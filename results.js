var counties = [
  { name: "Boyo", x: .73, y: .23, radius: .05 },
  { name: "Bui", x: .85, y: .3, radius: .05 },
  { name: "Donga-Mantung", x: .85, y: .17, radius: .075 },
  { name: "Fako", x: .3, y: .9, radius: .075 },
  { name: "Kupe", x: .425, y: .65, radius: .075 },
  { name: "Lebialem", x: .525, y: .475, radius: .075 },
  { name: "Manyu", x: .3, y: .425, radius: .125 },
  { name: "Meme", x: .325, y: .75, radius: .075 },
  { name: "Menchum", x: .625, y: .15, radius: .1 },
  { name: "Mezam", x: .65, y: .35, radius: .075 },
  { name: "Momo", x: .475, y: .275, radius: .075 },
  { name: "Ndian", x: .15, y: .7, radius: .1 },
  { name: "Ngo-Ketunjia", x: .75, y: .35, radius: .05 },
];

function province_dropdown() {
  counties.forEach(function (county) {
    document.write("<option value=\"" + county.name + "\">"
        + county.name + "</option>");
  });
}

function change_province(name) {
  if (name == "Show all provinces") {
    document.getElementById('selector').value = 'all';
  } else {
    document.getElementById('selector').value = name;
  }
}
