function setsliderBackground(price) {
    var slider = document.getElementById("userVal");
    var value = ((price - slider.min) / (slider.max - slider.min)) * 100;
    slider.style.background =
        "linear-gradient(to right, #d5e2ff 0%, #2271b1 " +
        value +
        "%, #f5f5f5 " +
        value +
        "%, #f5f5f5 100%)";
}

function priceChange(val) {
    var pricingData = [
        { range: [100, 100], base: 500, pp: 0 },
        { range: [101, 200], base: 600, pp: 0 },
        { range: [201, 300], base: 700, pp: 0 },
        { range: [301, 400], base: 800, pp: 0 },
        { range: [401, 500], base: 900, pp: 0 },
        { range: [501, 600], base: 1300, pp: 0 },
        { range: [601, 700], base: 2000, pp: 0 },
        { range: [701, 800], base: 2600, pp: 0 },

    ]
    var pricingDataMonthly = [
        { range: [100, 100], base: 89, pp: 0 },
        { range: [101, 200], base: 104, pp: 0 },
        { range: [201, 300], base: 119, pp: 0 },
        { range: [301, 400], base: 134, pp: 0 },
        { range: [401, 500], base: 149, pp: 0 },
        { range: [501, 600], base: 199, pp: 0 },
        { range: [601, 700], base: 249, pp: 0 },
        { range: [701, 800], base: 299, pp: 0 },
    ]
    var display = window.getComputedStyle(document.getElementById('slider-view')).getPropertyValue('display');

    var stepper = [
        { range: [100, 100], base: 100 },
        { range: [101, 200], base: 200, pp: 0 },
        { range: [201, 300], base: 300, pp: 0 },
        { range: [301, 400], base: 400, pp: 0 },
        { range: [401, 500], base: 500, pp: 0 },
        { range: [501, 600], base: 600, pp: 0 },
        { range: [601, 700], base: 700, pp: 0 },
        { range: [701, 800], base: 1100, pp: 0 },
    ]
    var sliderdom = document.getElementById("userVal");
    var stepperdata = stepper.filter(function (pricing) {
        return (val >= pricing.range[0] && val <= pricing.range[1])
    })[0]
    sliderPriceVal = stepperdata.base
    sliderdom.value = sliderPriceVal

    if (display == "block") {
        setsliderBackground(sliderPriceVal);
    }

    var priceLabel = [
        { range: [100, 100], base: 100 },
        { range: [103, 200], base: 200 },
        { range: [201, 300], base: 300 },
        { range: [301, 400], base: 400 },
        { range: [401, 500], base: 500 },
        { range: [501, 600], base: 1000 },
        { range: [601, 700], base: 2000 },
        { range: [701, 800], base: 6000 },
    ]
    var priceLabelData = priceLabel.filter(function (pricing) {
        return (val >= pricing.range[0] && val <= pricing.range[1])
    })[0]
    var percent = { 100: -1.05, 200: 12.65, 300: 26.25, 400: 40.55, 500: 54.05, 600: 68.25, 700: 82.25, 800: 93.55 }
    var tagspacing = { 100: -1, 200: 10, 300: 20.5, 400: 31.5, 500: 42, 600: 53, 700: 64, 800: 75, 900: 85.5, 1000: 96 }
    var contactdom = document.getElementById("contact-idp");
    var PricingDom = document.getElementById("PricingDom");
    var padding = document.getElementById("download-for-now");
    var paymentMethod = document.getElementById("paymentMethod");
    var pricingPlan = pricingData.filter(function (pricing) {
        return (val >= pricing.range[0] && val <= pricing.range[1])
    })[0]

    // update current value
    if (display == "block") {
        var domval = document.getElementById("priceTag");
        if (priceLabelData.base == 1100 || priceLabelData.base == 6000) {
            domval.innerHTML = '2000+';
        } else {
            domval.innerHTML = priceLabelData.base;
        }
    }

    var tooltipblock = document.getElementById("tooltip-price");
    if (val <= 800 && val > 700) {
        if (display == "block") {
            tooltipblock.style.display = "block";
        }
        contactdom.style.display = "block";
        PricingDom.style.display = "none";
        paymentMethod.style.display = "none";
        padding.style.marginTop = "10.4rem";
    } else {
        contactdom.style.display = "none";
        PricingDom.style.display = "block";
        tooltipblock.style.display = "none";
        paymentMethod.style.display = "block";
        padding.style.marginTop = "11.3rem";
    }

    if (display == "block") {
        domval.style.left = percent[val] + '%'
    }

    var pricingPlanMonthly = pricingDataMonthly.find(function (pricingM) {
        return val >= pricingM.range[0] && val <= pricingM.range[1];
    });

    // update pricing plan
    if (pricingPlan) {
        var domPrice = document.getElementById("userInput");
        var monthlyPriceDom = document.getElementById("userInputMonthly");

        if (pricingPlan.range[0] > 0 && pricingPlan.range[0] < 900) {
            var price = (pricingPlan.base)
            priceString = '$' + price
        }
        domPrice.innerHTML = priceString
    }

    if (pricingPlanMonthly) {
        if (pricingPlanMonthly.range[0] > 0 && pricingPlanMonthly.range[0] < 1001) {
            var MonPrice = pricingPlanMonthly.base;
            var MonPrice = '$' + MonPrice
        }
        monthlyPriceDom.innerHTML = MonPrice
    }
}

var storedValue = localStorage.getItem("sliderValue");
var initialValue = storedValue ? parseInt(storedValue, 10) : 100;
if (storedValue) {
    var sliderdom = document.getElementById("userVal");
    sliderdom.value = storedValue;
}
setsliderBackground(storedValue);
priceChange(initialValue);
var slider = document.getElementById("userVal");
slider.addEventListener("click", function (event) {
    var value = parseInt(event.target.value, 10);
    localStorage.setItem("sliderValue", value.toString());
    priceChange(value);
});


function numPriceChange(value) {
    priceChange(value);
    var sliderdom = document.getElementById("userVal");
    sliderdom.value = value;
    setsliderBackground(value);
}

function openDiv() {
    var contactDiv = document.getElementsByClassName('support-form-container');
    var contactDiv2 = document.getElementsByClassName('what_you_looking_for');
    contactDiv2[0].selectedIndex = 3;
    contactDiv[0].style.display = 'block';
}
