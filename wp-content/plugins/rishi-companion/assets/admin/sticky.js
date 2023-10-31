import { registerDynamicChunk } from 'rishi-frontend';
import { mountStickyHeader } from './header/sticky';

mountStickyHeader()
registerDynamicChunk('rishi_sticky_header', {
	mount: (el) => { },
})
