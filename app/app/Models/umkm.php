<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class umkm extends Model
{
    use HasFactory;

    /**
     * Get the getRT that owns the umkm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getRT(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rt_id', 'id');
    }

    /**
     * Get the getUser that owns the umkm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * Get the getKategori that owns the umkm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getKategori(): BelongsTo
    {
        return $this->belongsTo(kategori_umkm::class, 'kategori_umkm_id', 'id');
    }

    /**
     * Get the getJenis that owns the umkm
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getJenis(): BelongsTo
    {
        return $this->belongsTo(jenis_umkm::class, 'jenis_umkm_id', 'id');
    }

}
