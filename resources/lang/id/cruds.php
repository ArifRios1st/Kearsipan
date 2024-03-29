<?php

return [
    'userManagement' => [
        'title'          => 'Pengaturan',
        'title_singular' => 'pengaturan',
    ],
    'permission' => [
        'title'          => 'Izin',
        'title_singular' => 'Izin',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Peranan',
        'title_singular' => 'Peranan',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Daftar Pengguna',
        'title_singular' => 'User',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'name'                      => 'Name',
            'name_helper'               => ' ',
            'email'                     => 'Email',
            'email_helper'              => ' ',
            'email_verified_at'         => 'Email verified at',
            'email_verified_at_helper'  => ' ',
            'password'                  => 'Password',
            'password_helper'           => ' ',
            'roles'                     => 'Roles',
            'roles_helper'              => ' ',
            'remember_token'            => 'Remember Token',
            'remember_token_helper'     => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'verified'                  => 'Verified',
            'verified_helper'           => ' ',
            'verified_at'               => 'Verified at',
            'verified_at_helper'        => ' ',
            'verification_token'        => 'Verification token',
            'verification_token_helper' => ' ',
        ],
    ],
    'servicer' => [
        'title'          => 'Bidang/Seksi',
        'title_singular' => 'Bidang/Seksi',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'              => 'Bidang/Seksi',
            'name_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'letter-in' => [
        'title'          => 'Surat Masuk',
        'title_singular' => 'Surat Masuk',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'code'               => 'No Surat',
            'code_helper'        => ' ',
            'sender'             => 'Pengirim',
            'sender_helper'      => ' ',
            'regarding'          => 'Perihal',
            'regarding_helper'   => ' ',
            'date'               => 'Tanggal',
            'date_helper'        => ' ',
            'received_at'        => 'Diterima',
            'received_at_helper' => ' ',
            'disposition'        => 'Disposisi',
            'disposition_helper' => ' ',
            'file'               => 'File',
            'file_helper'        => ' ',
            'servicer'           => 'Bidang',
            'servicer_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'letter-out' => [
        'title'          => 'Surat Keluar',
        'title_singular' => 'Surat Keluar',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'code'              => 'Kode Surat',
            'code_helper'       => ' ',
            'receiver'          => 'Kepada',
            'receiver_helper'   => ' ',
            'regarding'         => 'Perihal',
            'regarding_helper'  => ' ',
            'sended_at'         => 'Tanggal Surat',
            'sended_at_helper'  => ' ',
            'file'              => 'File',
            'file_helper'       => ' ',
            'servicer'          => 'Pengolah',
            'servicer_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];
