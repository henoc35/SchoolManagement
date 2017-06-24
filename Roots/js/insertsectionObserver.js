if (NodeList.prototype.forEach === undefined) {
	NodeList.prototype.forEach = function (callback) {
		[].forEach.call(this, callback)
	}
}
let observer = new IntersectionObserver(function (observables) {
	observables.forEach(function (observable){
		if (observable.intersectionRatio > 0.5) {
			observable.target.classList.remove('not-visible')
			//observer.unobserve(observable.target)
		}/*else{
			observable.target.classList.add('not-visible')
		}*/
	})
	//console.log(entries);
},{
	threshold: [0.5]
})

//let items = document.querySelectorAll('text, .image')
let items = document.querySelectorAll('[data-observe]')
items.forEach(function (item){
	item.classList.add('not-visible')
	observer.observe(item) 
})