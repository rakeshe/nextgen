// var data = {title:"Test", time:"100 days", date:"never"}
// var raphael = r
// var path = boat_path
// var ba = new BoatAnimation(path, data, raphael)
// ba.start()


//HELPERS :)

var Direction = {
	LEFT_TO_RIGHT:"ltr",
	RIGHT_TO_LEFT:"rtl"
}
var Position = {
	TOP:"top",
	BOTTOM:"bottom"
}

//END HELPERS


//'Specialised' classes for each type of animation - CONSTRUCTOR
function BoatAnimation(path, data, raphael){
	//Constants to allow for cleaner code and easier to understand options (also make us look clever 8-) )
	this.direction = Direction.LEFT_TO_RIGHT;

	//Set where tooltips are
	this.tooltip_position = Position.BOTTOM;

	//add images using our useful ULImage *data model*
	this.images.sprite = new ULImage('img/part5/pond_ship.png',100,30);
	this.images.tooltip = new ULImage('img/part5/ship_tip.png',145,103);

	//keep path for later reference
	this.path = path;

	//Add the data for tooltip
	this.data = data;
	//Gets the data object boat_info

	//Add the raphael paper
	this.raphael = raphael;

}

//Standard *boiler plate* inheritance
BoatAnimation.prototype = new AnimationAlongLine();
BoatAnimation.prototype.constructor = BoatAnimation;



function PlaneAnimation(path, data, raphael){
	//Constants to allow for cleaner code and easier to understand options (also make us look clever 8-) )
	this.direction = Direction.RIGHT_TO_LEFT;

	//Set where tooltips are
	this.tooltip_position = Position.TOP;

	//add images using our useful ULImage *data model*
	this.images.sprite = new ULImage('img/part5/pond_plane.png',118,31);
	this.images.tooltip = new ULImage('img/part5/plane_tip.png',145,103);

	//keep path for later reference
	this.path = path;

	//Add the data for tooltip
	this.data = data;
	//Gets the data object boat_info

	//Add the raphael paper
	this.raphael = raphael;


}

PlaneAnimation.prototype = new AnimationAlongLine();
PlaneAnimation.prototype.constructor = PlaneAnimation;


function RailAnimation(path, data, raphael){
	//Constants to allow for cleaner code and easier to understand options (also make us look clever 8-) )
	this.direction = Direction.LEFT_TO_RIGHT;

	//Set where tooltips are
	this.tooltip_position = Position.TOP;

	//add images using our useful ULImage *data model*
	this.images.sprite = new ULImage('img/part5/america_train.png',102,56);
	this.images.tooltip = new ULImage('img/part5/america_tip.png',145,103);

	//keep path for later reference
	this.path = path;

	//Add the data for tooltip
	this.data = data;
	//Gets the data object boat_info

	//Add the raphael paper
	this.raphael = raphael;


}

RailAnimation.prototype = new AnimationAlongLine();
RailAnimation.prototype.constructor = PlaneAnimation;


function JetAnimation(path, data, raphael){
	//Constants to allow for cleaner code and easier to understand options (also make us look clever 8-) )
	this.direction = Direction.RIGHT_TO_LEFT;

	//Set where tooltips are
	this.tooltip_position = Position.BOTTOM;

	//add images using our useful ULImage *data model*
	this.images.sprite = new ULImage('img/part5/america_plane.png',133,40);
	this.images.tooltip = new ULImage('img/part5/usa_plane_tip.png',145,103);

	//keep path for later reference
	this.path = path;

	//Add the data for tooltip
	this.data = data;

	//Add the raphael paper
	this.raphael = raphael;
}

JetAnimation.prototype = new AnimationAlongLine();
JetAnimation.prototype.constructor = PlaneAnimation;







//'Camel case' name because it is a class
function AnimationAlongLine(){

	//Object variables
	this.images = {};
	this.counter = 0;
	this.prev_point;

	//Progress callback
	this.progress = function(){

	}

}


//A helper to help us store all the info about images
function ULImage(url, width, height){
	this.url = url;
	this.width = width;
	this.height = height;
}

AnimationAlongLine.prototype.start = function(){	
	this.addText()
	this.addImages();
	this.tick();
}


AnimationAlongLine.prototype.addText = function(){

	var map = this.raphael;
	//Add the tool tip text
	this.tip_text = map.text(0,0,this.data.title + "\n" + 
      this.data.time + "\n" + 
      this.data.date)

	this.tip_text.attr({
      stroke: "none",
      "font-weight":"lighter",
      "font-size": 16,
      fill:"white",
      'text-anchor': 'start'
   });
	
}

AnimationAlongLine.prototype.addImages = function(){
	this.tip_image = this.images.tooltip.convertToRaphael(this.raphael, 0, 0)
	this.sprite = this.images.sprite.convertToRaphael(this.raphael, 0, 0)
	this.positionImages(0)
}



//This function runs untill total length :)
AnimationAlongLine.prototype.positionImages = function(p){
	//SORRY THIS IS WAY TOO LONG :( 
	var length = this.path.getTotalLength();

	var pos = this.path.getPointAtLength((this.direction == Direction.LEFT_TO_RIGHT ? p : 1-p) * length);

	//convert to Point.js
	pos = new Point(pos.x, pos.y)

	//Position sprite
	var sprite_center = new Point(this.images.sprite.width/2, this.images.sprite.height/2);
	var sprite_position = Point.moveOrigin(pos, sprite_center) //Move point to middle of boat :)
	
	this.sprite.attr({x:sprite_position.x, y:sprite_position.y});
	
	//DO THE SAME FOR THE TOOLTIP YO

	var tooltip_center;

	if(this.tooltip_position == Position.BOTTOM){
		tooltip_center = new Point(this.images.tooltip.width/2, 0)
	}
	else{
		tooltip_center = new Point(this.images.tooltip.width/2, this.images.tooltip.height+60)

	}

	var tooltip_position = Point.moveOrigin(pos, tooltip_center)

	this.tip_image.attr({x:tooltip_position.x, y:tooltip_position.y + 25})

	//DO THE SAME FOR THE TOOLTIP TEXT YO

	this.tip_text.attr({x:tooltip_position.x + 10, y:tooltip_position.y + 85}).toFront();

	if(this.tooltip_position == Position.TOP){
		this.tip_text.attr({x:tooltip_position.x + 10, y:tooltip_position.y + 65}).toFront();
	}

	if(this.prev_point){
		var angle = Point.angle(this.prev_point, pos) - 90 - (this.direction == Direction.LEFT_TO_RIGHT ? 0 : 180);
        this.sprite.transform("R"+angle)
	}

	this.prev_point = pos

}


ULImage.prototype.convertToRaphael=function(paper, x, y){
	return paper.image(this.url, x, y, this.width, this.height)
}



//This function runs every frame :)
AnimationAlongLine.prototype.tick = function(){
	var self = this;
	this.counter+=0.002;
	this.positionImages(this.counter);
	if(this.progress) this.progress(this.counter)
	if(this.counter< 0.9){
		setTimeout(function(){
			self.tick()
		}, 30);
	} else{
		this.stop();
	}
}


AnimationAlongLine.prototype.stop = function(){
	this.sprite.animate({opacity:0},100, function(){ this.remove()})
    this.tip_text.animate({opacity:0},100, function(){ this.remove()})
  	this.tip_image.animate({opacity:0},100, function(){ this.remove()})
}
