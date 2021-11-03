class Carousel {

    /**
     *
     * @param {HTMLElement} element
     * @param {Object} options
     * @param {Object} [options.slidesToScroll=1] Nombre d'élements à faire défiler
     * @param {Object} [options.slidesVisible=1] Nombre d'élements dans un slide
     * @param {boolean} [options.pagination=false] pagination du carousel
     */
    constructor(element, options = {}) {
        this.element = element
        this.options = Object.assign({}, {
            slidesToScroll: 1,
            slidesVisible: 1,
            pagination:false
        }, options)
        let children = [].slice.call(element.children)
        this.isMobile=false;
        this.currentPost=0

        //modif dom
        this.root = this.createDivWithClass('carousel')
        this.wrapper = this.createDivWithClass('carousel__wrapper');
        this.root.setAttribute('tabindex','0')
        this.root.appendChild(this.wrapper)
        this.element.appendChild(this.root)
        this.posts = children.map((child) => {
            let post = this.createDivWithClass('carousel__post')
            post.appendChild(child)
            this.wrapper.appendChild(post)
            return post
        })
        this.setStyle()
        this.createNav()
        if(this.options.pagination) {
            this.createPagination()
        }


        //evnmt

        this.onWindowResize()
        window.addEventListener('resize',this.onWindowResize.bind(this))
        this.root.addEventListener('keyup',(e=>{
            if(e.key==='ArrowRight'|| e.key==='Right'){
                this.next()
            }else if(e.key==='ArrowLeft'|| e.key==='Left'){
                this.prev()
            }
        }))
    }

    /**
     * gère la dimmension d'un post du carousel
     */
    setStyle(){
        let ratio = this.posts.length / this.slidesVisible
        this.wrapper.style.width=(ratio*100)+"%"
        this.posts.forEach(post=>post.style.width=((100/this.slidesVisible)/ratio)+"%")
    }

    createNav(){
        let btnNext= this.createDivWithClass('carousel__next')
        let btnPrev= this.createDivWithClass('carousel__prev')
        this.root.appendChild(btnNext)
        this.root.appendChild(btnPrev)
        btnNext.addEventListener('click',this.next.bind(this))
        btnPrev.addEventListener('click',this.prev.bind(this))
    }
    createPagination() {
        let pagination = this.createDivWithClass('carousel__pagination')
        let buttons=[]
        this.root.appendChild(pagination)
        for(let i = 0; i <this.posts.length; i+=this.slidesToScroll){
            let button=this.createDivWithClass('carousel__pagination__button')
            button.addEventListener('click',()=>this.goToPost(i))
            pagination.appendChild(button)
            buttons.push(button)
        }

    }

    next(){
        this.goToPost(this.currentPost+this.slidesToScroll)

    }
    prev(){
        this.goToPost(this.currentPost-this.slidesToScroll)
    }

    /**
     *  Déplace le carousel vers l'élément ciblé
     * @param {number}index
     */
    goToPost(index){
        if (index<0){
            index=this.posts.length-this.slidesVisible
        } else if(index>=this.posts.length || (this.posts[this.currentPost+this.slidesVisible]===undefined && index>this.currentPost)){
            index=0
        }
        let translateX= index * -100 / this.posts.length
        this.wrapper.style.transform='translate3d('+ translateX +'%,0,0)'
        this.currentPost= index

    }

    onWindowResize(){
        let mobile = window.innerWidth<750
        if(mobile!== this.isMobile)
        this.isMobile=mobile
        this.setStyle()

    }


    /**
     *
     * @param {string}className
     * @return {HTMLElement}
     */
    createDivWithClass(className) {
        let div = document.createElement('div')
        div.setAttribute('class', className)
        return div

    }

    /**
     *
     * @returns {number|Object}
     */
    get slidesToScroll(){
        return this.isMobile?1:this.options.slidesToScroll

    }

    /**
     *
     * @returns {number|Object}
     */
    get slidesVisible(){
        return this.isMobile?1:this.options.slidesVisible
    }


}

document.addEventListener('DOMContentLoaded', function () {

    new Carousel(document.querySelector('#carousel1'), {
        slidesToScroll: 2,
        slidesVisible: 3,
        pagination:true
    })
})