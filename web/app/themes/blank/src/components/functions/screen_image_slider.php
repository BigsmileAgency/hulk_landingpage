<script>
    document.addEventListener('DOMContentLoaded', (e) => {
        const imageScreenCollection = document.querySelectorAll(".image_screen")
        const textScreenCollection = document.querySelectorAll(".text_screen")
        let entered = false
        let intervalID = 0
        let intervalEntity
        const optionsObserver = {
            target:document.querySelector('main'),
            rootMargin:'10px',
            threshold: .5
        }
        const observer = new IntersectionObserver(handleSectionVisible, optionsObserver);
        const targetObserver = document.querySelector("#feats_section_screen");
        observer.observe(targetObserver);

        textScreenCollection.forEach(textEl => {
            const idElement = textEl.dataset.textelement
            textEl.addEventListener('mouseenter',()=>{
                textScreenCollection.forEach(element => {
                    element.classList.remove('active')
                })
                imageScreenCollection.forEach(imgEl =>{
                    imgEl.style.opacity = "0"
                    if(imgEl.dataset.image == idElement){
                        imgEl.style.opacity = "1"
                    }
                })
                pauseSliding()
            })
            
            textEl.addEventListener('mouseleave',()=>{
                imageScreenCollection.forEach((imgEl,index) =>{
                    if(imgEl.dataset.image == idElement){
                        intervalID == 6 ? intervalID = 0 : intervalID = index + 1
                    }
                })
                startSliding()
            })
        })

        function startSliding(){
            intervalEntity = setInterval(function(){
                imageScreenCollection.forEach((imgEl,index) =>{
                    if(index == intervalID){
                        imgEl.style.opacity = "1"
                        textScreenCollection.forEach((textEl,index)=>{
                            textEl.classList.remove('active')
                            if(textEl.dataset.textelement == imgEl.dataset.image){
                                textEl.classList.add('active')
                            }
                        })
                    }else{
                        imgEl.style.opacity = "0"
                    }
                })
                intervalID == 6 ? intervalID = 0 : intervalID ++
            },3000)
        }

        function pauseSliding(){
            clearInterval(intervalEntity)
        }
        function handleSectionVisible(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if(!entered){
                    startSliding();
                    entered = true
                }
            }
        });
    }

})
</script>