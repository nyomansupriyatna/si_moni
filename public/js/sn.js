function withComa(x)
{
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function formatCurrency(input_id)
{

    if (document.querySelector("#" + input_id).value != "") {

        var angka = document.querySelector("#" + input_id).value;
        angka = angka.replace(/,/g, '');
        var hasil = withComa(angka);
        document.querySelector("#" + input_id).value = hasil;

    }

}

function hitungCost(cost_id, sale_id, prosen_id){

    let cost = $('#'+cost_id).val();
        cost = cost.replace(/,/g, '');
    let sale = $('#'+sale_id).val();
        sale = sale.replace(/,/g, '');
    let prosen = 0;

        // console.log(cost);
        console.log(sale);
    if(sale>0){
        prosen = (cost/sale)*100.00;
    }else{
        prosen = 0;
    }

    $('#'+prosen_id).val(prosen.toFixed(2)+'%');

}

function hitung_disc_percent()
{
    let disc_a = $('#disc_ammount').val();
    var price  = $('#price').val();
    var qty  = "{{$qty}}";
    alert(price);

    var disc_p= disc_p/100 * price * qty;
    // console.log('price: '+price);
    $('#disc_percent').val(disc_p);

}


function close_msg(msg_id){

    $('#'+msg_id).toggleClass("hidden");

}

function focus_me(id)
{
    $('#'+id).focus();
}

function terbilang(bilangan) {

    bilangan    = String(bilangan);
    var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
    var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
    var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');

    var panjang_bilangan = bilangan.length;

    /* pengujian panjang bilangan */
    if (panjang_bilangan > 15) {
      kaLimat = "Diluar Batas";
      return kaLimat;
    }

    /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
    for (i = 1; i <= panjang_bilangan; i++) {
      angka[i] = bilangan.substr(-(i),1);
    }

    i = 1;
    j = 0;
    kaLimat = "";


    /* mulai proses iterasi terhadap array angka */
    while (i <= panjang_bilangan) {

      subkaLimat = "";
      kata1 = "";
      kata2 = "";
      kata3 = "";

      /* untuk Ratusan */
      if (angka[i+2] != "0") {
        if (angka[i+2] == "1") {
          kata1 = "Seratus";
        } else {
          kata1 = kata[angka[i+2]] + " Ratus";
        }
      }

      /* untuk Puluhan atau Belasan */
      if (angka[i+1] != "0") {
        if (angka[i+1] == "1") {
          if (angka[i] == "0") {
            kata2 = "Sepuluh";
          } else if (angka[i] == "1") {
            kata2 = "Sebelas";
          } else {
            kata2 = kata[angka[i]] + " Belas";
          }
        } else {
          kata2 = kata[angka[i+1]] + " Puluh";
        }
      }

      /* untuk Satuan */
      if (angka[i] != "0") {
        if (angka[i+1] != "1") {
          kata3 = kata[angka[i]];
        }
      }

      /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
      if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")) {
        subkaLimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
      }

      /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
      kaLimat = subkaLimat + kaLimat;
      i = i + 3;
      j = j + 1;

    }

    /* mengganti Satu Ribu jadi Seribu jika diperlukan */
    if ((angka[5] == "0") && (angka[6] == "0")) {
      kaLimat = kaLimat.replace("Satu Ribu","Seribu");
    }

    return kaLimat + "Rupiah";
}

function tampil_terbilang(bilangan){

    terbilang(bilangan);

}



