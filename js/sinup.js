(function(){

    const fonts= ["cursive", "sans-serif", "serif", "monospace"];
    
    let captchavalue = "";
    
    function generateCaptcha(){ 
    let value = btoa (Math.random()*1000000000); 
    value = value.substr(0, 5+Math.random()*5);
    
    captchavalue = value; 
    }
    
    function setCaptcha(){
    
    captchavalue.split("").map((char)=>{
    
    const rotate= -20+ Math.trunc(Math.random()*30); 
    const font = Math.trunc (Math.random()*fonts.length);
    
    return `<span
    style= "
    transform:rotate(${rotate}deg);
    font-family:${fonts= [font]}"
    >${char}</span>`;
    
     }).join("");
      document.querySelector(".signup_form .preview").innerHTML = html;
    
    }
    
    function initCaptcha(){ 
        document.querySelector("captcha-refresh").addEventListener("click", function(){
    
    generateCaptcha(); 
     setCaptcha();
    

        });
        generateCaptcha(); 
     setCaptcha();
    }
    
    
 initCaptcha();
 })();
