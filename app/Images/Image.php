<?php namespace App\Images;

use App\Gallery\Models\ObjectImage;
use Eloquent;
use \Intervention\Image\Facades\Image as InterventionImage;

/**
 * Class Gallery
 *
 */
class Image extends Eloquent {

    /**
     * @param \Imaginable $object
     */
    public function __construct(\App\Interfaces\Imaginable $object )
    {
        $this->table  = $object->getTable();
        $this->folder = $object->getFolder();
    }

    /**
     * @var string
     */
    protected $table;

    /**
     * @var string
     */
    protected $folder;

	/**
	 * @const string
	 */
	const PUBLISHED_AT = 'published_at';

	/**
	 * @var array
	 */
	protected $guarded = ['id', 'author_id'];

	/**
	 * @var array
	 */
	protected $dates = ['deleted_at', self::PUBLISHED_AT];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeWithAuthor($query)
    {
        return $query->with('author');
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->ext;
    }

    public function getRealfilepath()
    {
        return $this->getHandler()->getPath().$this->id.'.'.$this->getExtension();
    }

    /**
     * @return string
     */
    public function getFilepath($size)
    {
        return $this->getFilefolder($size).'/'.$this->getFilename();
    }

    /**
     * @return string
     */
    public function getFilefolder($size)
    {
        return public_path().$this->folder.$size;
    }

    /**
     * @return string
     */
    public function getUrl($size)
    {
        return $this->folder.$size.'/'.$this->getFilename();
    }

    public function getImage($size)
    {
        if ( !$size ) {
            $size = '640x480';
        }

        if ( !file_exists($this->getFilepath($size)) ) {
            $this->makeFile($size);
        }

        return $this->getUrl($size);
    }

    private function makeFile($size)
    {
        if (!file_exists($this->getFilefolder($size)))
            mkdir($this->getFilefolder($size), 0777);

        $sizer = new ImageSizes($size);

        return InterventionImage::make( $this->getRealfilepath() )
            ->resize( $sizer->getWidth(), $sizer->getHeight(), function($constraint) {
                $constraint->aspectRatio();
            })->save( $this->getFilepath($sizer) );
    }

    public function getHandler()
    {
        if ( !$this->handler ) {
            $this->handler = new ObjectImage($this->owner);
        }
        return $this->handler;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function remove()
    {
        return $this->getHandler()->remove($this);
    }
}
