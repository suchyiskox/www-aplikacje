var loadedimg = new Image();
var filter1checkbox;
var filter2checkbox;
var filter4checkbox;
var filterColor;
var filterOpacity;
var filterOpacityValueField;
var imageLoader;
var canvas;
var ctx;
var figureSpace;
var figureSpaceValue;
var figureSpaceValueField;
var rgbaColor;
var photoBrightness;
var photoBrightnessField;
var photoOpacity;
var photoOpacityField;
var colorRed;
var colorGreen;
var colorBlue;
var colorRedField;
var colorGreenField;
var colorBlueField;
var photoGrayness;
var photoColorEditor;
var colorRedCheck;
var colorGreenCheck;
var colorBlueCheck;
var imageData;

function handleImage(e) {
    init();
    clear();
    clearPhotoFilters();
    var reader = new FileReader();
    reader.onload = function (event) {
        var img = new Image();
        img.onload = function () {
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
        };
        img.src = event.target.result;
        loadedimg = img;
    };
    reader.readAsDataURL(e.target.files[0]);
}

function isLoaded() {
    return !(loadedimg.width === 0 || loadedimg.height === 0);
}

function clear() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    if (isLoaded())
        ctx.drawImage(loadedimg, 0, 0);
}

function init() {
    canvas = document.getElementById('imageCanvas');
    ctx = canvas.getContext('2d');
    imageLoader = document.getElementById('imageLoader');
    imageLoader.addEventListener('change', handleImage, false);
    loadSettings();
}

function loadSettings() {
    filter1checkbox = document.getElementById('filter1checkbox');
    filter2checkbox = document.getElementById('filter2checkbox');
    filter4checkbox = document.getElementById('filter4checkbox');
    filterColor = document.getElementById('filterColor');
    filterOpacity = document.getElementById('filterOpacity');
    filterOpacityValueField = document.getElementById('filterOpacityValue');
    figureSpace = document.getElementById('figureSpace');
    figureSpaceValue = parseInt(figureSpace.value);
    figureSpaceValueField = document.getElementById('filterSpaceValue');
    photoBrightness = document.getElementById('photoBrightness');
    photoBrightnessField = document.getElementById('photoBrightnessValue');
    photoOpacity = document.getElementById('photoOpacity');
    photoOpacityField = document.getElementById('photoOpacityValue');
    colorRed = document.getElementById('photoRed');
    colorRedField = document.getElementById('photoRedValue');
    colorGreen = document.getElementById('photoGreen');
    colorGreenField = document.getElementById('photoGreenValue');
    colorBlue = document.getElementById('photoBlue');
    colorBlueField = document.getElementById('photoBlueValue');
    photoGrayness = document.getElementById('photoGrayness');
    photoColorEditor = document.getElementById('photoColorEditor');
    colorRedCheck = document.getElementById('colorRedCheck');
    colorGreenCheck = document.getElementById('colorGreenCheck');
    colorBlueCheck = document.getElementById('colorBlueCheck');
}

function applyFilter() {
    loadSettings();
    if (isLoaded()) {
        if (filter1checkbox.checked) {
            filter1();
        }
        if (filter2checkbox.checked) {
            filter2();
        }
        if (filter4checkbox.checked) {
            filter4();
        }
    }

}

function applyPhotoFilter(colorfilter) {
    loadSettings();
    clear();
    if (isLoaded()) {
        ctx.filter = "brightness(" + photoBrightness.value + "%)";
        ctx.drawImage(loadedimg, 0, 0);
        if (photoColorEditor.checked) {
            imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            for (var i = 0; i < imageData.data.length; i += 4) {
                if (colorfilter === colorRed)
                    imageData.data[i] = colorRed.value;
                if (colorfilter === colorGreen)
                    imageData.data[i + 1] = colorGreen.value;
                if (colorfilter === colorBlue)
                    imageData.data[i + 2] = colorBlue.value;
                imageData.data[i + 3] = photoOpacity.value;
            }
            if (photoGrayness.checked) {
                for (var a = 0; a < imageData.data.length; a += 4) {
                    var brightness = 0.34 * imageData.data[a] + 0.5 * imageData.data[a + 1] + 0.16 * imageData.data[a + 2];
                    imageData.data[a] = brightness;
                    imageData.data[a + 1] = brightness;
                    imageData.data[a + 2] = brightness;
                }
            }
            ctx.putImageData(imageData, 0, 0);
        }
        applyFilter();
    } else {
        clearPhotoFilters();
        alert("Nie dodano zdjęcia");
    }
}

function clearPhotoFilters() {
    loadSettings();
    photoBrightness.value = 100;
    photoBrightnessField.innerHTML = photoBrightness.value;
    colorRed.value = 0;
    colorRedField.innerHTML = colorRed.value;
    colorGreen.value = 0;
    colorGreenField.innerHTML = colorGreen.value;
    colorBlue.value = 0;
    colorBlueField.innerHTML = colorBlue.value;
    photoOpacity.value = 255;
    photoOpacityField.innerHTML = photoOpacity.value;
    photoGrayness.checked = false;
    photoColorEditor.checked = false;
}

function filter1() {
    loadSettings();
    if (isLoaded()) {
        clear();
        if (!filter1checkbox.checked || filter2checkbox.checked || filter4checkbox.checked) {
            filter4checkbox.checked = false;
            filter2checkbox.checked = false;
        }
        if (filter1checkbox.checked) {
            printKitties();
        }
    } else {
        filter1checkbox.checked = false;
        alert("Nie dodano zdjęcia");
    }
}

function filter2() {
    loadSettings();
    if (isLoaded()) {
        clear();
        if (!filter2checkbox.checked || filter1checkbox.checked || filter4checkbox.checked) {
            filter1checkbox.checked = false;
            filter4checkbox.checked = false;
        }
        if (filter2checkbox.checked) {
            printHams();
        }
    } else {
        filter2checkbox.checked = false;
        alert("Nie dodano zdjęcia");
    }
}


function filter4() {
    loadSettings();
    if (isLoaded()) {
        if (!filter4checkbox.checked || filter2checkbox.checked || filter1checkbox.checked) {
            filter1checkbox.checked = false;
            filter2checkbox.checked = false;

        }
        if (filter4checkbox.checked) {
            clear();
            printKitties();
            printHams();
        }
    } else {
        filter4checkbox.checked = false;
        alert("Nie dodano zdjęcia");
    }
}

function setColorAndOpacity() {
    var color = filterColor.value;
    var opacity = filterOpacity.value;
    rgbaColor = hexToRgbA(color, opacity);
    ctx.strokeStyle = rgbaColor;
    ctx.fillStyle = rgbaColor;
}

function printKitties() {
    var ramka = new Image();
    setColorAndOpacity();
    ramka.onload = function () {
    };
    console.log();
roundRect(140 + figureSpaceValue / 2, 90 + figureSpaceValue / 2, loadedimg.width - 2 * (140 + figureSpaceValue / 2), loadedimg.height - 2 * (figureSpaceValue / 2 + 90));
}

function printHams() {
    var jaszczurka = new Image();
    var dragon = new Image();
    jaszczurka.src = "img/jaszczurka.png";
    dragon.src = "img/dragon.png";
    jaszczurka.onload = function () {
        ctx.drawImage(jaszczurka, loadedimg.width / 3 - 100, 800, 100, 100);
        ctx.drawImage(jaszczurka, loadedimg.width / 5 - 200, loadedimg.height - 800, 100, 200);
    };
    dragon.onload = function () {
        ctx.drawImage(dragon, 100, loadedimg.height / 2, 50, 50);
        ctx.drawImage(dragon, loadedimg.width - 150, loadedimg.height / 2, 50, 50);
    }

}
function roundRect(x, y, width, height, radius, fill, stroke) {
    if (typeof stroke === 'undefined') {
        stroke = true;
    }
    if (typeof radius === 'undefined') {
        radius = 5;
    }
    if (typeof radius === 'number') {
        radius = {tl: radius, tr: radius, br: radius, bl: radius};
    } else {
        var defaultRadius = {tl: 0, tr: 0, br: 0, bl: 0};
        for (var side in defaultRadius) {
            radius[side] = radius[side] || defaultRadius[side];
        }
    }
    ctx.beginPath();
    ctx.moveTo(x + radius.tl, y);
    ctx.lineWidth = 10;
    ctx.lineTo(x + width - radius.tr, y);
    ctx.quadraticCurveTo(x + width, y, x + width, y + radius.tr);
    ctx.lineTo(x + width, y + height - radius.br);
    ctx.quadraticCurveTo(x + width, y + height, x + width - radius.br, y + height);
    ctx.lineTo(x + radius.bl, y + height);
    ctx.quadraticCurveTo(x, y + height, x, y + height - radius.bl);
    ctx.lineTo(x, y + radius.tl);
    ctx.quadraticCurveTo(x, y, x + radius.tl, y);
    ctx.closePath();
    if (fill) {
        ctx.fill();
    }
    if (stroke) {
        ctx.stroke();
    }
}

function hexToRgbA(hex, opacity) {
    var c;
    if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
        c = hex.substring(1).split('');
        if (c.length === 3) {
            c = [c[0], c[0], c[1], c[1], c[2], c[2]];
        }
        c = '0x' + c.join('');
        return 'rgba(' + [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(',') + ',' + opacity / 100 + ')';
    }
    throw new Error('Bad Hex');
}

function showFilterValue(filterValue, field) {
    field.innerHTML = filterValue.value;
}