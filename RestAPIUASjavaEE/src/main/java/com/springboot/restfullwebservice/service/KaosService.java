package com.springboot.restfullwebservice.service;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.springboot.restfullwebservice.Enitity.Kaos;
import com.springboot.restfullwebservice.repository.KaosRepository;

import java.util.List;
import java.util.Optional;

@Service
public class KaosService {

    private final KaosRepository kaosRepository;

    @Autowired
    public KaosService(KaosRepository kaosRepository) {
        this.kaosRepository = kaosRepository;
    }

    public List<Kaos> getAllKaos() {
        return kaosRepository.findAll();
    }

    public Kaos getKaosById(Long id) {
        return kaosRepository.findById(id).orElse(null);
    }

    public Kaos createKaos(Kaos kaos) {
        return kaosRepository.save(kaos);
    }

    public Kaos updateKaos(Long id, Kaos updatedKaos) {
        Optional<Kaos> kaosOptional = kaosRepository.findById(id);
        if (kaosOptional.isPresent()) {
            Kaos kaos = kaosOptional.get();
            kaos.setUkuran(updatedKaos.getUkuran());
            kaos.setHarga(updatedKaos.getHarga());
            kaos.setKeterangan(updatedKaos.getKeterangan());
            return kaosRepository.save(kaos);
        }
        return null;
    }

    public boolean deleteKaos(Long id) {
        if (kaosRepository.existsById(id)) {
            kaosRepository.deleteById(id);
            return true;
        }
        return false;
    }
}
