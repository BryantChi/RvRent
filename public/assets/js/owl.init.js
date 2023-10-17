//Owl Carousel
// $('#client-testi').owlCarousel({
//   loop:true,
//   nav: false,
//   dots: true,
//   autoplay:true,
//   autoplayTimeout:3000,
//   autoplayHoverPause:true,
//   responsive:{
//       0:{
//           items:1
//       },
//       600:{
//           items:2
//       }
//   }
// });

$('#client-testi').owlCarousel({
    loop:true,
    nav: true,
    dots: true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        992:{
            items:4
        }
    }
  });

//   $('#special-plan').owlCarousel({
//     loop:true,
//     nav: true,
//     dots: true,
//     autoplay:true,
//     autoplayTimeout:3000,
//     autoplayHoverPause:true,
//     responsive:{
//         0:{
//             items:1
//         },
//         600:{
//             items:1
//         },
//         992:{
//             items:3
//         }
//     }
//   });

//   setTimeout(function () {
//     $('#special-plan .owl-nav').attr('disabled', false);
//     $('#special-plan .owl-dots').attr('disabled', false);
//   }, 1000);


//   $('#hero').owlCarousel({
//     loop:true,
//     nav:false,
//     dots: false,
//     autoplay:true,
//     autoplayTimeout:3000,
//     autoplayHoverPause:true,
//     responsive:{
//         0:{
//             items:1
//         },
//         600:{
//             items:1
//         },
//         992:{
//             items:1
//         }
//     }
//   });
