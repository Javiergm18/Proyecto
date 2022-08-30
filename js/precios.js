const rangoInput = document.querySelectorAll(".rango-input input"),
priceInput = document.querySelectorAll(".precioEntrada input"),
rango = document.querySelector(".slider .progreso");
let priceGap = 1000;
priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
        maxPrice = parseInt(priceInput[1].value);
        
        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangoInput[1].max){
            if(e.target.className === "input-min"){
                rangoInput[0].value = minPrice;
                rango.style.left = ((minPrice / rangoInput[0].max) * 100) + "%";
            }else{
                rangoInput[1].value = maxPrice;
                rango.style.right = 100 - (maxPrice / rangoInput[1].max) * 100 + "%";
            }
        }
    });
});
rangoInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangoInput[0].value),
        maxVal = parseInt(rangoInput[1].value);
        if((maxVal - minVal) < priceGap){
            if(e.target.className === "rango-min"){
                rangoInput[0].value = maxVal - priceGap
            }else{
                rangoInput[1].value = minVal + priceGap;
            }
        }else{
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            rango.style.left = ((minVal / rangoInput[0].max) * 100) + "%";
            rango.style.right = 100 - (maxVal / rangoInput[1].max) * 100 + "%";
        }
    });
});