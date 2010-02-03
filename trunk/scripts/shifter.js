/**
 * @desc Ajax based shifter of content with animation.
 * @author Andrius Virbičianskas <andrius@virbicianskas.lt>
 * @copyright 2010, Andrius Virbičianskas
 * @package shifter
 * @license GNU GPL
 * @url http://www.virbicianskas.lt/
 * @version 0.1.0
 * @dependencies prototype.js 1.6.1+, effects.js 1.8.3+
 */
var Shifter = Class.create({
  initialize: function(url) {
    this.url = url;
    
    this.wrapper_id = arguments[1].wrapper || 'wrapper';
    this.container_id = arguments[1].container || 'container';
    this.frame_id = arguments[1].frame || 'frame';
    this.backward_id = arguments[1].backward || 'backward';
    this.forward_id = arguments[1].forward || 'forward';
    this.animation = arguments[1].animation || 'spring';
    this.duration = arguments[1].duration || 1;
    this.event = arguments[1].event || 'click';

    this.init();
    this.preload();
    this.observe();
  },
  
  init: function() {
    this.container = $(this.container_id);
    this.backward = $(this.backward_id);
    this.forward = $(this.forward_id);
    
    this.width = $(this.wrapper_id).getWidth();
  },
  
  observe: function() {
    this.backward.observe(this.event, this.execute.bind(this)); 
    this.forward.observe(this.event, this.execute.bind(this));
  },
  
  stop: function() {
    this.backward.stopObserving();
    this.forward.stopObserving();
  },
  
  preload: function() {
    this.insert(this.backward_id, true);
    this.insert(this.backward_id, true);
    this.insert(this.forward_id, true);
    this.insert(this.forward_id, true);
    this.insert(this.forward_id, true);
    
    this.position();
  },
  
  insert: function(direction, preload) {
    new Ajax.Request(this.url, {
      method:'get',
      asynchronous: false,
      parameters: {direction: direction,
                   preload: preload},
      onComplete: function(transport) {
        var frame = new Element('div', {class: 'frame'});
        frame.update(transport.responseText);

        if (direction == this.backward_id) {
          this.container.insert({top: frame});
          
          if (preload == false) {
            this.position();
          }
        }
        if (direction == this.forward_id) {
          this.container.insert({bottom: frame});
        }
      }.bind(this)
    });
  },

  execute: function(event) {    
    this.stop();
    
    var direction = event.findElement('.').id;
    
    if (direction == this.backward_id) {
      var displacement = -this.width;
    }
    if (direction == this.forward_id) {
      var displacement = this.width;
    }
    
    switch (this.animation) {
      case 'linear':
        var animation = Effect.Transitions.linear;
      break;
      
      case 'sinoidal':
        var animation = Effect.Transitions.sinoidal;
      break;
      
      case 'spring':
        var animation = Effect.Transitions.spring;
      break;
    }
    
    new Effect.Move(this.container, {x: displacement, 
                                     y: 0, 
                                     mode: 'relative', 
                                     transition: animation,
                                     duration: this.duration});

    this.renew.bind(this).delay(this.duration + 0.1, direction);
    this.observe.bind(this).delay(this.duration + 0.1);
  },
  
  renew: function(direction) {
    var frames = this.container.select('div.frame');
    
    if (direction == this.backward_id) {
      var element = frames.first();
      element.remove();
      
      this.position();
      this.insert(this.forward_id, false);
    }
    
    if (direction == this.forward_id) {
      var element = frames.last();
      element.remove();
      
      this.insert(this.backward_id, false);
    }
  },
  
  position: function() {
    var offset = this.width * 2;
    this.container.setStyle({
      left: '-' + offset + 'px'
    });
  }
});