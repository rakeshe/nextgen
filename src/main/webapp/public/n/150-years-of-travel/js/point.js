function Point(x,y){
	this.x=x;
	this.y=y;	
}

Point.prototype.subtract=function(p){
	return new Point(this.x-p.x,this.y-p.y);
}

Point.prototype.minus = Point.prototype.subtract;

Point.prototype.add=function(p){
	return new Point(this.x+p.x,this.y+p.y);
}

Point.prototype.multiply=function(p){
	return new Point(this.x*p.x,this.y*p.y);
}

Point.prototype.divide=function(p){
	return new Point(this.x/p.x,this.y/p.y);
}

Point.prototype.toString=function(){
	return "{"+[this.x, this.y].join(",")+"}"
}

Point.prototype.SVGString=function(pre){
	return pre+this.x+" "+this.y;
}

Point.prototype.round = {
	x: Math.round(this.x),
	y: Math.round(this.y)
}

Point.interpolate=function(p1,p2,t){
	var x=p1.x+(t*(p2.x-p1.x));
	var y=p1.y+(t*(p2.y-p1.y));
	return new Point(x,y);
}

Point.gradient=function(p1,p2){
	return (p2.y-p1.y)/(p2.x-p1.x);
}

Point.normal=function(p1,p2,d){
	var p3=Point.interpolate(p1,p2,0.5); //halfway point
	var p4=p2.subtract(p1);
	var cart=Point.cartesian(p4); 
	var p5=Point.polar(d,cart[1]+1.57079633);  //angle+90 deg
	p5=p5.add(p3);
	return p5;
}

Point.polar=function(r,t){
	return new Point(r*Math.cos(t),r*Math.sin(t));
}

Point.cartesian=function(p){
	var x=p.x
	var y=p.y
	var r=Math.sqrt(Math.pow(y,2)+Math.pow(x,2));
	var t;
	if(x>0){
		t=Math.atan(y/x);
	}
	if(x<0 && y>=0){
		t=Math.atan(y/x)+Math.PI;
	}
	if(x<0 && y<0){
		t=Math.atan(y/x)-Math.PI;
	}
	if(x==0 && y>0){
		t=Math.PI/2;
	}
	if(x==0 && y<0){
		t=-Math.PI/2
	}
	if(x==0 && y==0){
		t=0;
	}
	return [r,t];
}

Point.angle=function(p1, p2){
	calcAngle = Math.atan2(p1.x-p2.x,p1.y-p2.y)*(180/Math.PI);	
	if(calcAngle < 0)	
	calcAngle = Math.abs(calcAngle);
	else
	calcAngle = 360 - calcAngle;		
	return calcAngle;
}
Point.moveOrigin = function(origin, newOrigin){
	return origin.subtract(newOrigin);
}

