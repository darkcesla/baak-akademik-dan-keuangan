package com.springboot.restfullwebservice.Enitity;

import javax.persistence.*;

import java.time.LocalDateTime;
import java.util.Date;

@Entity
@Table(name = "surat_izin_keluar")
public class SuratIzinKeluar {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id;

    @ManyToOne
    @JoinColumn(name = "id_users")
    private User user;

    @Column(name = "keterangan")
    private String keterangan;

    @Column(name = "waktu_berangkat")
    private LocalDateTime waktuBerangkat;

    @Column(name = "waktu_kembali")
    private LocalDateTime waktuKembali;

    @Column(name = "status")
    private String status;

    // Constructor, getters, and setters
    // 
    
    public SuratIzinKeluar() {}
    public SuratIzinKeluar(Long id, User user, String keterangan, LocalDateTime waktuBerangkat,
			LocalDateTime waktuKembali, String status) {
		super();
		this.id = id;
		this.user = user;
		this.keterangan = keterangan;
		this.waktuBerangkat = waktuBerangkat;
		this.waktuKembali = waktuKembali;
		this.status = status;
	}

    // 
    public Long getId() {
        return id;
    }



	public void setId(Long id) {
        this.id = id;
    }


    public User getUser() {
		return user;
	}

	public void setUser(User user) {
		this.user = user;
	}

	public String getKeterangan() {
        return keterangan;
    }

    public void setKeterangan(String keterangan) {
        this.keterangan = keterangan;
    }

    public LocalDateTime getWaktuBerangkat() {
        return waktuBerangkat;
    }

    public void setWaktuBerangkat(LocalDateTime waktuBerangkat) {
        this.waktuBerangkat = waktuBerangkat;
    }

    public LocalDateTime getWaktuKembali() {
        return waktuKembali;
    }

    public void setWaktuKembali(LocalDateTime waktuKembali) {
        this.waktuKembali = waktuKembali;
    }

    public String getStatus() {
        return status;
    }

    public void setStatus(String status) {
        this.status = status;
    }
}
