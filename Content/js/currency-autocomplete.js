$(function(){
  var currencies = [
    { value: 'Asus Fonepad 8 FE380CG'},
{ value: 'Asus Zenfone 2 - ZE550ML 1.8G/ 2GB/ 16GB '},
{ value: 'Asus Zenfone 2 - ZE551ML - 2.3G/ 4GB/ 64GB '},
{ value: 'Asus ZenFone Go (ZC500TG)'},
{ value: 'Asus Zenfone Selfie'},
{ value: 'Asus Zenfone Selfie'},
{ value: 'Bao da iPad Air 2 LAB.C'},
{ value: 'Bao da iPad Air 2 Totu'},
{ value: 'Bao da iPad Mini Tucano Angolo'},
{ value: 'Bao da iPhone 6 Icon TL'},
{ value: 'Cáp iPhone 4 Remax 1m'},
{ value: 'Cáp Lightning - micro usb Remax 1m'},
{ value: 'Cáp Micro Usb Remax 1m'},
{ value: 'HTC Butterfly 2 '},
{ value: 'HTC Desire 728G Dual Sim '},
{ value: 'HTC Desire 820Q '},
{ value: 'HTC Desire 826 Dual Sim'},
{ value: 'HTC One E8 Dual '},
{ value: 'HTC One E9 Dual SIM'},
{ value: 'HTC One M8 Eye'},
{ value: 'HTC One M9'},
{ value: 'iPad Air 2 Wi-Fi + Cellular 128GB - Retina'},
{ value: 'iPad Air 2 Wi-Fi 16GB - Retina'},
{ value: 'iPad mini 3 Wifi 4G 64GB'},
{ value: 'iPad mini 3 Wifi 4G 64GB'},
{ value: 'iPhone 5S 16GB '},
{ value: 'iPhone 6 16GB'},
{ value: 'iPhone 6 64GB'},
{ value: 'iPhone 6 Plus 64GB'},
{ value: 'iPhone 6s Plus 128GB'},
{ value: 'Laptop Acer E5-571G-59BZ'},
{ value: 'Laptop Asus GL552JX-XO093D'},
{ value: 'Laptop Asus K551LN-XX330D/Core i7-4510U'},
{ value: 'Laptop Asus TP550LD-CJ084H/Core i3-4030U/VGA 2G'},
{ value: 'Laptop Asus X454LA-VX193B/Core i3 4030U/WIN8.1'},
{ value: 'Laptop Dell Inspiron 14 3451 XJWD61 - Black'},
{ value: 'Laptop Dell N5548/i5-5200U'},
{ value: 'Laptop Dell N5558/i7/15.6"/VGA 4GB/Win8.1'},
{ value: 'Laptop HP Probook G2 450/Core i5-4210U/VGA 2G'},
{ value: 'Laptop Lenovo ThinkPad X1 Carbon C3'},
{ value: 'Laptop Toshiba L40-AS125X-PSKHWL-00D001/i5-4200U/2GB/500GB/VGA 2G'},
{ value: 'Lenovo Tab 2 Wifi A7-10'},
{ value: 'MDMH 8" cắt thủ công'},
{ value: 'MDMH iPad Air (bóng)'},
{ value: 'MDMH Kính cường lực Note 5'},
{ value: 'MDMH Kính cường lực Remax iPhone 6 Plus'},
{ value: 'MDMH Kính cường lực Samsung E5-E500'},
{ value: 'Microsoft Lumia 430'},
{ value: 'Microsoft Lumia 535 '},
{ value: 'Microsoft Lumia 540 Dual SIM'},
{ value: 'Microsoft Lumia 640 XL'},
{ value: 'Miếng dán màn hình iPad Mini 4 (Trong)'},
{ value: 'Ốp lưng iPhone 6 Totu'},
{ value: 'Ốp lưng iPhone 6 X-doria Bump'},
{ value: 'OPPO Find 7 - X9076'},
{ value: 'OPPO Mirror 3'},
{ value: 'OPPO Mirror 5 '},
{ value: 'OPPO R1k'},
{ value: 'OPPO R7 Lite'},
{ value: 'OPPO R7 Plus '},
{ value: 'Philips W3500 '},
{ value: 'Philips Xenium I908 '},
{ value: 'Philips Xenium I908'},
{ value: 'Philips Xenium W6610'},
{ value: 'Sạc dự phòng Adata 10000mAh'},
{ value: 'Sạc Dự phòng Ipower 3400mAh'},
{ value: 'Sạc dự phòng Maxco 6000mAh'},
{ value: 'Sạc dự phòng Smart 3400mAh'},
{ value: 'Sạc dự phòng Yoobao 6000 mAh'},
{ value: 'Sạc ĐT USB Icore 1 cổng 1A cho ĐT'},
{ value: 'Sạc ô tô iCore Dual - Port Fast Charger'},
{ value: 'Sạc USB Icore 2 cổng 1A/2A'},
{ value: 'Samsung Galaxy A5'},
{ value: 'Samsung Galaxy A7 '},
{ value: 'Samsung Galaxy A8'},
{ value: 'Samsung Galaxy J1'},
{ value: 'Samsung Galaxy J7 (N'},
{ value: 'Samsung Galaxy Note 5 '},
{ value: 'Samsung Galaxy S6 Edge'},
{ value: 'Samsung Galaxy S6 Edge Plus'},
{ value: 'Samsung Galaxy Tab A 8.0 inch (S-pen)'},
{ value: 'Samsung Galaxy Tab E'},
{ value: 'Tablet Acer A1-830 Wifi Intel Z2560'},
{ value: 'Tablet Acer A1-841'},
{ value: 'Tablet iPad Air 2 Wifi 4G 16GB'},
{ value: 'Tablet Samsung T805 - Tab S 10.5 inch'},
{ value: 'Tai nghe choàng đầu Sennheiser HD180'},
{ value: 'Tai nghe có mic Somic Senicc MX123'},
{ value: 'Tai nghe không Mic Sennheiser CX213'},
{ value: 'Tai nghe Sony Earpod MDR-E9LP'},
{ value: 'Wing Iris 50'},
{ value: 'Wing Iris 55'},
{ value: 'Wing P4000 '},
{ value: 'Wing V45'},
{ value: 'Wing V50'},
];
  
  $('#autocomplete').autocomplete({
    lookup: currencies,
  });
  

});