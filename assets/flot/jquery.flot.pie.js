!function(e){var i=10,s=.95,t={series:{pie:{show:!1,radius:"auto",innerRadius:0,startAngle:1.5,tilt:1,shadow:{left:5,top:15,alpha:.02},offset:{top:0,left:"auto"},stroke:{color:"#fff",width:1},label:{show:"auto",formatter:function(e,i){return"<div style='font-size:x-small;text-align:center;padding:2px;color:"+i.color+";'>"+e+"<br/>"+Math.round(i.percent)+"%</div>"},radius:1,background:{color:null,opacity:0},threshold:0},combine:{threshold:-1,color:null,label:"Other"},highlight:{opacity:.5}}}};e.plot.plugins.push({init:function(r){function a(i,s,r){y||(y=!0,w=i.getCanvas(),k=e(w).parent(),t=i.getOptions(),i.setData(l(i.getData())))}function l(i){for(var s=0,r=0,a=0,l=t.series.pie.combine.color,n=[],o=0;o<i.length;++o)p=i[o].data,e.isArray(p)&&1==p.length&&(p=p[0]),e.isArray(p)?!isNaN(parseFloat(p[1]))&&isFinite(p[1])?p[1]=+p[1]:p[1]=0:p=!isNaN(parseFloat(p))&&isFinite(p)?[1,+p]:[1,0],i[o].data=[p];for(o=0;o<i.length;++o)s+=i[o].data[0][1];for(o=0;o<i.length;++o)(p=i[o].data[0][1])/s<=t.series.pie.combine.threshold&&(r+=p,a++,l||(l=i[o].color));for(o=0;o<i.length;++o){var p=i[o].data[0][1];(a<2||p/s>t.series.pie.combine.threshold)&&n.push({data:[[1,p]],color:i[o].color,label:i[o].label,angle:p*Math.PI*2/s,percent:p/(s/100)})}return a>1&&n.push({data:[[1,r]],color:l,label:t.series.pie.combine.label,angle:r*Math.PI*2/s,percent:r/(s/100)}),n}function n(r,a){function l(){m.clearRect(0,0,n,p),k.children().filter(".pieLabel, .pieLabelBackground").remove()}if(k){var n=r.getPlaceholder().width(),p=r.getPlaceholder().height(),h=k.children().filter(".legend").children().width()||0;m=a,y=!1,M=Math.min(n,p/t.series.pie.tilt)/2,A=p/2+t.series.pie.offset.top,P=n/2,"auto"==t.series.pie.offset.left?t.legend.position.match("w")?P+=h/2:P-=h/2:P+=t.series.pie.offset.left,P<M?P=M:P>n-M&&(P=n-M);var g=r.getData(),c=0;do{c>0&&(M*=s),c+=1,l(),t.series.pie.tilt<=.8&&function(){var e=t.series.pie.shadow.left,i=t.series.pie.shadow.top,s=t.series.pie.shadow.alpha,r=t.series.pie.radius>1?t.series.pie.radius:M*t.series.pie.radius;if(!(r>=n/2-e||r*t.series.pie.tilt>=p/2-i||r<=10)){m.save(),m.translate(e,i),m.globalAlpha=s,m.fillStyle="#000",m.translate(P,A),m.scale(1,t.series.pie.tilt);for(var a=1;a<=10;a++)m.beginPath(),m.arc(0,0,r,0,2*Math.PI,!1),m.fill(),r-=a;m.restore()}}()}while(!function(){function i(e,i,s){e<=0||isNaN(e)||(s?m.fillStyle=i:(m.strokeStyle=i,m.lineJoin="round"),m.beginPath(),Math.abs(e-2*Math.PI)>1e-9&&m.moveTo(0,0),m.arc(0,0,r,a,a+e/2,!1),m.arc(0,0,r,a+e/2,a+e,!1),m.closePath(),a+=e,s?m.fill():m.stroke())}var s=Math.PI*t.series.pie.startAngle,r=t.series.pie.radius>1?t.series.pie.radius:M*t.series.pie.radius;m.save(),m.translate(P,A),m.scale(1,t.series.pie.tilt),m.save();for(var a=s,l=0;l<g.length;++l)g[l].startAngle=a,i(g[l].angle,g[l].color,!0);if(m.restore(),t.series.pie.stroke.width>0){for(m.save(),m.lineWidth=t.series.pie.stroke.width,a=s,l=0;l<g.length;++l)i(g[l].angle,t.series.pie.stroke.color,!1);m.restore()}return o(m),m.restore(),!t.series.pie.label.show||function(){for(var i=s,r=t.series.pie.label.radius>1?t.series.pie.label.radius:M*t.series.pie.label.radius,a=0;a<g.length;++a){if(g[a].percent>=100*t.series.pie.label.threshold&&!function(i,s,a){if(0==i.data[0][1])return!0;var l,o=t.legend.labelFormatter,h=t.series.pie.label.formatter;l=o?o(i.label,i):i.label,h&&(l=h(l,i));var g=(s+i.angle+s)/2,c=P+Math.round(Math.cos(g)*r),u=A+Math.round(Math.sin(g)*r)*t.series.pie.tilt,d="<span class='pieLabel' id='pieLabel"+a+"' style='position:absolute;top:"+u+"px;left:"+c+"px;'>"+l+"</span>";k.append(d);var f=k.children("#pieLabel"+a),v=u-f.height()/2,b=c-f.width()/2;if(f.css("top",v),f.css("left",b),0-v>0||0-b>0||p-(v+f.height())<0||n-(b+f.width())<0)return!1;if(0!=t.series.pie.label.background.opacity){var w=t.series.pie.label.background.color;null==w&&(w=i.color);var M="top:"+v+"px;left:"+b+"px;";e("<div class='pieLabelBackground' style='position:absolute;width:"+f.width()+"px;height:"+f.height()+"px;"+M+"background-color:"+w+";'></div>").css("opacity",t.series.pie.label.background.opacity).insertBefore(f)}return!0}(g[a],i,a))return!1;i+=g[a].angle}return!0}()}()&&c<i);c>=i&&(l(),k.prepend("<div class='error'>Could not draw pie with labels contained inside canvas</div>")),r.setSeries&&r.insertLegend&&(r.setSeries(g),r.insertLegend())}}function o(e){if(t.series.pie.innerRadius>0){e.save();var i=t.series.pie.innerRadius>1?t.series.pie.innerRadius:M*t.series.pie.innerRadius;e.globalCompositeOperation="destination-out",e.beginPath(),e.fillStyle=t.series.pie.stroke.color,e.arc(0,0,i,0,2*Math.PI,!1),e.fill(),e.closePath(),e.restore(),e.save(),e.beginPath(),e.strokeStyle=t.series.pie.stroke.color,e.arc(0,0,i,0,2*Math.PI,!1),e.stroke(),e.closePath(),e.restore()}}function p(e,i){for(var s=!1,t=-1,r=e.length,a=r-1;++t<r;a=t)(e[t][1]<=i[1]&&i[1]<e[a][1]||e[a][1]<=i[1]&&i[1]<e[t][1])&&i[0]<(e[a][0]-e[t][0])*(i[1]-e[t][1])/(e[a][1]-e[t][1])+e[t][0]&&(s=!s);return s}function h(e,i){for(var s,t,a=r.getData(),l=r.getOptions(),n=l.series.pie.radius>1?l.series.pie.radius:M*l.series.pie.radius,o=0;o<a.length;++o){var h=a[o];if(h.pie.show){if(m.save(),m.beginPath(),m.moveTo(0,0),m.arc(0,0,n,h.startAngle,h.startAngle+h.angle/2,!1),m.arc(0,0,n,h.startAngle+h.angle/2,h.startAngle+h.angle,!1),m.closePath(),s=e-P,t=i-A,m.isPointInPath){if(m.isPointInPath(e-P,i-A))return m.restore(),{datapoint:[h.percent,h.data],dataIndex:0,series:h,seriesIndex:o}}else if(p([[0,0],[n*Math.cos(h.startAngle),n*Math.sin(h.startAngle)],[n*Math.cos(h.startAngle+h.angle/4),n*Math.sin(h.startAngle+h.angle/4)],[n*Math.cos(h.startAngle+h.angle/2),n*Math.sin(h.startAngle+h.angle/2)],[n*Math.cos(h.startAngle+h.angle/1.5),n*Math.sin(h.startAngle+h.angle/1.5)],[n*Math.cos(h.startAngle+h.angle),n*Math.sin(h.startAngle+h.angle)]],[s,t]))return m.restore(),{datapoint:[h.percent,h.data],dataIndex:0,series:h,seriesIndex:o};m.restore()}}return null}function g(e){u("plothover",e)}function c(e){u("plotclick",e)}function u(e,i){var s=r.offset(),a=h(parseInt(i.pageX-s.left),parseInt(i.pageY-s.top));if(t.grid.autoHighlight)for(var l=0;l<I.length;++l){var n=I[l];n.auto!=e||a&&n.series==a.series||f(n.series)}a&&d(a.series,e);var o={pageX:i.pageX,pageY:i.pageY};k.trigger(e,[o,a])}function d(e,i){var s=v(e);-1==s?(I.push({series:e,auto:i}),r.triggerRedrawOverlay()):i||(I[s].auto=!1)}function f(e){null==e&&(I=[],r.triggerRedrawOverlay());var i=v(e);-1!=i&&(I.splice(i,1),r.triggerRedrawOverlay())}function v(e){for(var i=0;i<I.length;++i)if(I[i].series==e)return i;return-1}function b(e,i){var s=e.getOptions(),t=s.series.pie.radius>1?s.series.pie.radius:M*s.series.pie.radius;i.save(),i.translate(P,A),i.scale(1,s.series.pie.tilt);for(var r=0;r<I.length;++r)!function(e){e.angle<=0||isNaN(e.angle)||(i.fillStyle="rgba(255, 255, 255, "+s.series.pie.highlight.opacity+")",i.beginPath(),Math.abs(e.angle-2*Math.PI)>1e-9&&i.moveTo(0,0),i.arc(0,0,t,e.startAngle,e.startAngle+e.angle/2,!1),i.arc(0,0,t,e.startAngle+e.angle/2,e.startAngle+e.angle,!1),i.closePath(),i.fill())}(I[r].series);o(i),i.restore()}var w=null,k=null,M=null,P=null,A=null,y=!1,m=null,I=[];r.hooks.processOptions.push(function(e,i){i.series.pie.show&&(i.grid.show=!1,"auto"==i.series.pie.label.show&&(i.legend.show?i.series.pie.label.show=!1:i.series.pie.label.show=!0),"auto"==i.series.pie.radius&&(i.series.pie.label.show?i.series.pie.radius=.75:i.series.pie.radius=1),i.series.pie.tilt>1?i.series.pie.tilt=1:i.series.pie.tilt<0&&(i.series.pie.tilt=0))}),r.hooks.bindEvents.push(function(e,i){var s=e.getOptions();s.series.pie.show&&(s.grid.hoverable&&i.unbind("mousemove").mousemove(g),s.grid.clickable&&i.unbind("click").click(c))}),r.hooks.processDatapoints.push(function(e,i,s,t){e.getOptions().series.pie.show&&a(e)}),r.hooks.drawOverlay.push(function(e,i){e.getOptions().series.pie.show&&b(e,i)}),r.hooks.draw.push(function(e,i){e.getOptions().series.pie.show&&n(e,i)})},options:t,name:"pie",version:"1.1"})}(jQuery);