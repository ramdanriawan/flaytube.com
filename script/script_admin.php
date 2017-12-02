<?php 
function base_url()
{
  return "http://$_SERVER[SERVER_NAME]/project/flaytube.com2";
}

?>

$(document).ready(function() {
  var tambah_chanel = $("#tambah_chanel");
  
// untuk loader

var loader = $("#loader");
function loaderShow(){
  loader.gSpinner({
    scale: 0.2
  });
}

function loaderHide()
{
  loader.gSpinner("hide");
}


loaderHide();
 
  tambah_chanel.submit(function(event) {
    event.preventDefault();
    loaderShow();
    var This = $(this);
    
    var data = This.serialize();
    var kategory = prompt("Inputkan kategory chanel", "Education");
    
    $.ajax({
      url     : "<?php echo base_url() . '/index.php/Ctesturl/ctesturlf';?>",
      data    : data,
      success : function(response){
        
        This.css('background-color');
        
        if(response == "success"){
            
            $.ajax({
              url    : "<?php echo base_url() . '/index.php/Csavedb/csavedbcolumn';?>",
              data   : data+`&kategory=${kategory}`,
              success: function(response){
                loaderHide();

                if(response == "success"){
                  console.log("success menambah data, semua data videos dan playlists akan autoupdate setiap 10 menit, klik tombol get data untuk mendapatkan data secara manual");
                  // //window.location.href = //window.location.href;
                }else {
                  console.log("Gagal menambah url chanel, mungkin terjadi duplicate, atau mungkin salah memasukkan url atau koneksi internet terputus");
                }
              }
            }).fail(function(){
              loaderHide();
              console.log("gagal menambah url chanel, silakan ulangi request!");
            }).always(function(){
              loaderHide();
            });
          
        }else{
          console.log("Gagal menambah url chanel, mungkin terjadi duplicate, atau mungkin salah memasukkan url atau koneksi internet terputus");
        }
      }
      
    }).fail(function(){
      loaderHide();
      console.log("gagal menambah url chanel, silakan ulangi request!");
    }).always(function(){
      loaderHide();
    })
  
});

var btn_get_data = $("#btn-get-data");
modal_get_data = $("#modal-get-data");
loader_get_data = $("#loader-get-data");

modal_get_data.hide();

  btn_get_data.click(function(event) {
    event.preventDefault();

    modal_get_data.show();
    loader_get_data.gSpinner();

    var This = $(this);
    This.css("background-color", "yellow");
    
    $.ajax({
      url: "<?php echo base_url() . '/index.php/Cserveryoutube/cserveryoutubef';?>",
      data: {update : "active"},
      success: function(response){
        loader_get_data.gSpinner("hide");
        modal_get_data.hide();
        console.log("Berhasil mengupdate data chanel");
        This.css('background-color');
        // //window.location.href = //window.location.href;
      }
    }).fail(function(){
      console.log("Gagal mengupdate data chanel");
      loader_get_data.gSpinner("hide");
    }).always(function(){
      loader_get_data.gSpinner("hide");
      console.log("success");
    })
    
  });
  
  var a_delete = $("a.delete");
  
  a_delete.click(function(event){
    event.preventDefault();
    var This = $(this);
    var href = This.attr("href");
    var id = This.attr("data-id");
    var media = This.attr("data-media");
    var nilai = window.confirm(`Apakah Anda Yakin Akan Menghapus media ${media}`);
    
    if(nilai){
      $.ajax({
        url : href,
        success: function(response){
          if(response == "success"){
            console.log("Data Berhasil Di Hapus");
            //window.location.href = //window.location.href;
          }else {
            console.log("Gagal Menghapus Data, Silakan Coba Lagi!");
          }
        }
      }).fail(function(){
        console.log("Gagal Terhubung Ke Server")
      })
    }
    
  })


  var more_videos = $("#more_videos");

  more_videos.submit(function(event){
    loaderShow();
    event.preventDefault();

    var data = $(this).serialize();
    var name = $(this).find("select :selected").text();

    $.ajax({
      url : "<?php echo base_url() . '/index.php/Cmore/cmore_videos';?>",
      data :  `media=v&name=${name}&` + data,
      type: "POST",
      success: function(response){
        loaderHide();
        console.log(response);
      }
    }).fail(function(){
      loaderHide();
      console.log("Gagal mengambil response yang diberikan");
    }).always(function(){
      loaderHide();
      console.log("berhasil menambah data videos dari response yang diberikan");
    })
  })

  //untuk more playlists
  var more_playlists = $("#more_playlists");

  more_playlists.submit(function(event){
    loaderShow();
    event.preventDefault();

    var data = $(this).serialize();
    var name = $(this).find("select :selected").text();

    $.ajax({
      url : "<?php echo base_url() . '/index.php/Cmore/cmore_videos';?>",
      data: `media=p&name=${name}&` + data,
      type : "POST",
      success : function(response){
        loaderHide();
        console.log(response);
      }
    }).fail(function(){
      loaderHide();
      console.log("Gagal mengambil response yang diberikan");
    }).always(function(){
      loaderHide();
      console.log("berhasil menambah data videos dari response yang diberikan");
    })
  })

})

