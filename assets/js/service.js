const urlParams = new URLSearchParams(window.location.search);
const serviceId = urlParams.get("id")

console.log(serviceId);


fetch("/assets/service.json")
.then((response) => response.json())
.then((services) => {
    const details = services.find((b) => b.id == serviceId);
    console.log(details);

    if(details){
        document.querySelectorAll(".service_title").forEach((title) => {
            title.textContent = details.serviceTitle
        })
        document.getElementById('service_img').src = details.serviceImg
        document.getElementById('service_disc').textContent = details.serviceDiscription
        document.getElementById('service_p1').textContent = details.servicePoint1
        document.getElementById('service_p2').textContent = details.servicePoint2
        document.getElementById('service_p3').textContent = details.servicePoint3
        document.getElementById('service_p4').textContent = details.servicePoint4
        document.getElementById('service_pdisc').textContent = details.serviePostline
        document.getElementById('service_how').textContent = details.serviceHow
        document.getElementById("ques1").textContent = details.serviceQue1
        document.getElementById("ans1").textContent = details.serviceAns1 
        document.getElementById("ques2").textContent = details.serviceQue2
        document.getElementById("ans2").textContent = details.serviceAns2
        document.getElementById("ques3").textContent = details.serviceQue3
        document.getElementById("ans3").textContent = details.serviceAns3 
                
    }
})