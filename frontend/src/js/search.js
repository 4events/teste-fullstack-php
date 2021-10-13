export default class Search
{
    constructor() {
        this.searchIdentify = ".search"
        this.searchShowClass = "search-show"
        this.el = document.querySelector(this.searchIdentify)
    }

    hasOpen () {
        return this.el.classList.contains(this.searchShowClass)
    }

    open () {
        this.el.classList.add(this.searchShowClass)
    }

    close () {
        this.el.classList.remove(this.searchShowClass)
    }

    change () {
        if(this.hasOpen()) this.close()
        else this.open()
    }
}