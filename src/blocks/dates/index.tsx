import { registerBlockType } from '@wordpress/blocks';
import block from './block.json';
import Edit from './Edit';
import './style.scss';

registerBlockType( block.name, {
	apiVersion: 3,
	title: block.title,
	category: block.category,
	icon: block.icon,
	description: block.description,
	edit: Edit,
	save: () => null,
} );
