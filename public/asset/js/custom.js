// to get current year
function getYear() {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    if(document?.querySelector("#displayYear")){
        document.querySelector("#displayYear").innerHTML = currentYear;
    }
}

getYear();


// client section owl carousel
if($(".client_owl-carousel").owlCarousel){
    $(".client_owl-carousel")?.owlCarousel({
        loop: true,
        margin: 0,
        dots: false,
        nav: true,
        navText: [],
        autoplay: true,
        autoplayHoverPause: true,
        navText: [
            '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            '<i class="fa fa-angle-right" aria-hidden="true"></i>'
        ],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    });
}




/** google_map js **/
function myMap() {
    var mapProp = {
        center: new google.maps.LatLng(40.712775, -74.005973),
        zoom: 18,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
}


$(document).ready(function() {
    $('#scrollToTopLink').click(function(e) {
      e.preventDefault();
      var targetUrl = $(this).attr('href');
      if(window.location.pathname==targetUrl){
        $('html, body').animate({ scrollTop: 0 }, 'slow');
      }else{
        window.location.href=targetUrl;
      }
    });
  });

/*   DELETE BTN */

async function showConfirmation(id) {
    $('#'+id.id).modal('show');
  }
  
function confirmAction() {
    // Perform your desired action here
    alert('Confirmed!');
    $('#confirmationModal').modal('hide');
};


function handleCategory(e){
    if($('#selectcategory')[0].value!='n'){
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.delete('page')
        urlParams.set('category', $('#selectcategory')[0].value);
        window.location.search = urlParams;
    }else{
        window.location.href=window.location.pathname
    }
    /* window.location.href='/products?category={{}}' */
}

function handleStatus(e){
    if($('#status')[0].value!='All'){
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('status', $('#status')[0].value);
        urlParams.delete('page')
        window.location.search = urlParams;
    }else{
        window.location.href=window.location.pathname
    }
    /* window.location.href='/products?category={{}}' */
}

function appendSearchParam() {
    const searchInput = document.getElementById('searchInput');
    const searchTerm = searchInput.value;
    console.log('searchTerm')

    const urlParams = new URLSearchParams(window.location.search);
    urlParams.delete('page');
    urlParams.set('search', searchTerm);

    window.location.search = urlParams;
    return false; // Prevents the form from submitting normally
  }

//HANDLE PRICE
const priceCut = document.querySelectorAll('#priceCut');
priceCut.forEach(e=>{
    let num;
    if(e.textContent>=1000000){
        num = e.textContent/1000000
        if(!(Number.isInteger(num))){
            num=(num).toFixed(1);    
        }
        e.textContent=num + 'M';
    }else{
        if(e.textContent>=1000){
            num = e.textContent/1000
            if(!(Number.isInteger(num))){
                num=(num).toFixed(1);    
            }
            e.textContent=num + 'k';
        }
    }
    
})

/* HANDLE DISCOUNT */

function handleDiscount(){
    if($('#discountinput')[0].disabled){
        $('#discountinput')[0].disabled=false
    }else{
        $('#discountinput')[0].value=''
        $('#discountinput')[0].disabled=true

    }
}