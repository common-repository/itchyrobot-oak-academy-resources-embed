( function( blocks, editor ,element, data ) {
    var el = element.createElement;
    var InspectorControls = editor.InspectorControls;
    var {Component}  = wp.element;
    var {SelectControl}  = wp.components;
    var options;

    class mySelectPosts extends Component {

        
        // Method for setting the initial state.
        static getInitialState( selectedPost ) {
          return {
            posts: [],
            selectedPost: selectedPost,
            post: {}, 
          };
        }

        // Constructing our component. With super() we are setting everything to 'this'.
        // Now we can access the attributes with this.props.attributes
        constructor() {
            super( ...arguments );
            this.state = this.constructor.getInitialState( this.props.attributes.selectedPost );
            // Bind so we can use 'this' inside the method.
    
            // Bind it.
            this.onChangeSelectPost = this.onChangeSelectPost.bind(this);
          }
    
          onChangeSelectPost( value ) {
            // Find the post
            //var post = value;
            var titlel = "";
             options.forEach((option) => {
                    if(option.value == value){
                      titlel = option.label;
                    }
                 });
              console.log(value);
              this.setState( { selectedPost: value } );
              // Set the attributes
              this.props.setAttributes( {
                selectedPost: value,
                title: 'Oak Academy: '+ titlel,
                link: ''
              });
            
          }
          
      
        render() {
            var el = wp.element.createElement;	
            options = [ { value: '', label: ( 'Select a year group' ) } ];
            var output  =  ( 'Loading Year Groups' );
            options.push({value:'reception', label:'Reception'});
            options.push({value:'year-1', label:'Year One'});
            options.push({value:'year-2', label:'Year Two'});
            options.push({value:'year-3', label:'Year Three'});
            options.push({value:'year-4', label:'Year Four'});
            options.push({value:'year-5', label:'Year Five'});
            options.push({value:'year-6', label:'Year Six'});


            output = ( 'Select a year group from the right hand menu' );
    
                if ( this.props.attributes.title != "" ) {              
                   output= el( 'h2', { }, this.props.attributes.title);
             } 
            return [
                this.props.isSelected && ( 
                    el(
                                    InspectorControls,
                                    { key: 'controls' },
                                  
                                    el(
                                        SelectControl,
                                        {
                                            label:( 'Select a year group' ),
                                            value:this.props.attributes.selectedPost,
                                            options: options,
                                            onChange: this.onChangeSelectPost
                                        }
                                    )
                                )
                       
                 ),
          output
        ]
         }
      }

    blocks.registerBlockType( 'itchyrobot-oak-tree/oak-tree-resource', {
        title: 'iTCHYROBOT: Oak Academy Resources',
        icon: 'universal-access-alt',
        category: 'layout',
        supports: { 
            align: true,
        },
        attributes: {
              title: {
                type: 'string',
                selector: 'h2',
                default: 'Please select a year group',
              },
              link: {
                type: 'string',
                selector: 'a',
                default: 'Please select a year group',
              },
              selectedPost: {
                type: 'string',
                default: '',
              },
        },
      
        edit: mySelectPosts,

        save: function( props ) {
          
           return;//el( 'h2', { }, props.attributes.title);
       
        },
    } );
}(
    window.wp.blocks,
    window.wp.editor,
    window.wp.element,
    window.wp.data,
) );