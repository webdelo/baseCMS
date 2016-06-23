<?php namespace App\Gallery\Models;

use App\Images\ObjectImage;
use App\Images\ImageSizes;
use App\User;
use Eloquent;
use \Intervention\Image\Facades\Image as InterventionImage;

/**
 * Class Gallery
 *
 */
class Image extends Eloquent {

    private $owner;
    private $handler;
    /**
     * @var string
     */
    protected $table = 'albums_images';

    /**
     * @var string
     */
    protected $folder = '/data/images/gallery/';

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
            $this->handler = new GalleryImageHandler($this->getOwner());
        }
        return $this->handler;
    }

    private function getOwner()
    {
        if (!$this->owner) {
            $albums = new Album();
            $this->owner = $albums->find($this->objectId);
        }

        return $this->owner;
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