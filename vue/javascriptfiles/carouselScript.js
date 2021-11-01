class Carousel {

    /**
     *
     * @param {HTMLElement} element
     * @param {Object} options
     * @param {Object} options.slidesToScroll Nombre d'élements à faire défiler
     * @param {Object} options.slidesVisible Nombre d'élements dans un slide
     */
    constructor(element, options = {}) {
        this.element = element
        this.options = Object.assign({}, {
            slidesToScroll: 1,
            slidesVisible: 1
        }, options)
        let children = [].slice.call(element.children)
        this.currentPost=0
        this.root = this.createDivWithClass('carousel')
        this.wrapper = this.createDivWithClass('carousel__wrapper');
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
    }

    /**
     * gère la dimmension d'un post du carousel
     */
    setStyle(){
        let ratio = this.posts.length / this.options.slidesVisible
        this.wrapper.style.width=(ratio*100)+"%"
        this.posts.forEach(post=>post.style.width=((100/this.options.slidesVisible)/ratio)+"%")
    }

    createNav(){
        let btnNext= this.createDivWithClass('carousel__next')
        let btnPrev= this.createDivWithClass('carousel__prev')
        this.root.appendChild(btnNext)
        this.root.appendChild(btnPrev)
        btnNext.addEventListener('click',this.next.bind(this))
        btnPrev.addEventListener('click',this.prev.bind(this))
    }

    next(){
        this.goToItem(this.currentPost+this.options.slidesToScroll)

    }
    prev(){
        this.goToItem(this.currentPost-this.options.slidesToScroll)
    }

    /**
     *  Déplace le carousel vers l'élément ciblé
     * @param {number}index
     */
    goToItem(index){
        if (index<0){
            index=this.posts.length-this.options.slidesVisible
        } else if(index>=this.posts.length || this.posts[this.currentPost+this.options.slidesVisible]===undefined ){
            index=0
        }
        let translateX= index * -100 / this.posts.length
        this.wrapper.style.transform='translate3d('+ translateX +'%,0,0)'
        this.currentPost= index

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
}

document.addEventListener('DOMContentLoaded', function () {

    new Carousel(document.querySelector('#carousel1'), {
        slidesToScroll: 2,
        slidesVisible: 3
    })
})