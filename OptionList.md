# Option List #

  * `wrapper_id` - The main wrapper ID. Default: `wrapper`<sup>1</sup>.
  * `container_id` - The main container ID. Default: `container`<sup>1</sup>.
  * `frame_id` - Element class. Default: `frame`<sup>1</sup>.
  * `backward_id` - The backward element id to observe. Default: `backward`<sup>2</sup>.
  * `forward_id` - The forward element id to observe. Default: `forward`<sup>2</sup>.
  * `animation` - Animation type. Default: `spring`. Available: `linear, sinoidal, spring`.
  * `duration` - The duration of the animation. Default: `1` sec.
  * `event` - The event on which change is triggered.. Default: `click`.

**<sup>1</sup>** - If you change element ids, don't forget to change them in the provided css file. <br />
**<sup>2</sup>** - If you change direction ids and are using provided carousel and glider classes, you MUST change the direction values there too.