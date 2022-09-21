function randomImage() {
var fileNames = [
    "1.jpeg", "2.jpeg", "3.jpeg", "4.jpeg", "5.jpeg", "6.jpeg", "7.jpeg", "8.jpeg", "9.jpeg", "10.jpeg", "11.jpeg", "12.jpeg", "13.jpeg", "14.jpeg"
];
var randomIndex = Math.floor(Math.random() * fileNames.length);

$("#card__img").attr("src", "assets/card_skin/"+fileNames[randomIndex]);
}
randomImage();


var cardNumtxt = JSON.parse(cardnum);
var strlenght = cardNumtxt.split("").length;
for (var i = 0; i < strlenght; i++) {
  // cardNumtxt[i]
  if (i > 0 && (i % 4) == 0) {
    $('#card_user').append('<span><div class="card-item__numberItem -active"> </div></span>');
    $('#card_user').append('<span><div class="card-item__numberItem">'+cardNumtxt[i]+'</div></span>');
  }
  else{
    $('#card_user').append('<span><div class="card-item__numberItem">'+cardNumtxt[i]+'</div></span>');
  }
}